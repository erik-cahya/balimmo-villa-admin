<?php

namespace App\Http\Controllers\Admin\Docs;

use App\Http\Controllers\Controller;
use App\Models\ClientModel;
use App\Models\PropertiesModel;
use App\Models\PropertyLeadsModel;
use App\Models\User;
use App\Models\VisitDocsModel;
use App\Models\VisitPropertyDocsModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocsVisitController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'Master') {
            $data['visit_docs'] = VisitDocsModel::select(
                'visit_docs.id',
                'visit_docs.first_name',
                'visit_docs.last_name',
                'visit_docs.email',
                'visit_docs.phone_number',
                'visit_docs.status_docs',
                'visit_docs.visit_date',
                'visit_docs.reference_code as agentCode'
            )->get();
        } else {
            $data['visit_docs'] = VisitDocsModel::where('visit_docs.reference_code', Auth::user()->reference_code)
                ->select(
                    'visit_docs.id',
                    'visit_docs.first_name',
                    'visit_docs.last_name',
                    'visit_docs.email',
                    'visit_docs.phone_number',
                    'visit_docs.status_docs',
                    'visit_docs.visit_date',
                    'visit_docs.reference_code as agentCode'

                )->get();
        }

        $data['property_list'] = VisitPropertyDocsModel::join('properties', 'properties.id', '=', 'visit_property_docs.property_id')
            ->join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
            ->select(
                'properties.property_address',
                'properties.internal_reference',
                'properties.property_name',
                'property_financial.selling_price_idr',
                'property_financial.selling_price_usd',
                'visit_property_docs.docs_visit_id'
            )
            ->get()
            ->groupBy('docs_visit_id');


        return view('admin.docs.visit.index', $data);
    }

    public function create()
    {
        $rawDataLeads = PropertyLeadsModel::where('agent_code', Auth::user()->reference_code)
            ->where('prospect_status', 1)
            ->select('property_leads.id as leadsId', 'cust_name', 'cust_email', 'cust_telp')
            ->get()
            ->groupBy('cust_email');

        $finalData = [];

        foreach ($rawDataLeads as $email => $leads) {
            $lead = $leads->first(); // Ambil satu instance untuk ambil nama dan telp

            $nameParts = explode(' ', $lead->cust_name);
            $firstName = array_shift($nameParts);
            $lastName  = implode(' ', $nameParts);

            $finalData[] = [
                'first_name'   => $firstName,
                'last_name'    => $lastName,
                'email'        => $lead->cust_email,
                'phone_number' => $lead->cust_telp,
                'leadsId' => $lead->leadsId,
            ];
        }

        $data['data_client'] = $finalData;

        $data['data_property'] = PropertiesModel::select(
            'properties.id',
            'properties.id as propertyId',
            'properties.internal_reference',
            'properties.property_code',
            'properties.property_name',
            'properties.property_address',
            'properties.region',
            'properties.sub_region',
            'property_financial.selling_price_idr',
            'property_financial.selling_price_usd',

            'users.name as agentName'
        )
            ->join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
            ->join('users', 'users.reference_code', '=', 'properties.internal_reference')
            ->with(['featuredImage' => function ($query) {
                $query->where('is_featured', 1);
            }])
            ->get();

        return view('admin.docs.visit.create', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $dataClient = explode('||', $request->input('dataClients'));
        // dd($dataClient[4]);

        $request->validate([
            'dataClients' => 'required',
            'date_visit' => 'required',
        ]);

        if ($request->propertyId == null) {
            return back()->withErrors(['propertiesNull' => 'Please check the properties']);
        }
        $nameDocs = 'visit_docs_' . str::slug(Auth::user()->name) . '_' . $request->date_visit;

        $docsVisit = VisitDocsModel::create([
            'name_docs' => $nameDocs,
            'first_name' => $dataClient[1],
            'last_name' => $dataClient[2],
            'email' => $dataClient[0],
            'phone_number' => $dataClient[3],
            'visit_date' => Carbon::createFromFormat('d-m-Y', $request->date_visit)->format('Y-m-d'),
            'reference_code' => Auth::user()->reference_code,
            'status_docs' => 2
        ]);

        foreach ($request->propertyId as $idProperty) {
            VisitPropertyDocsModel::create([
                'docs_visit_id' => $docsVisit->id,
                'property_id' => $idProperty,
            ]);
        }

        PropertyLeadsModel::where('id', $dataClient[4])->update(['docs_status' => 1]);

        $flashData = [
            'judul' => 'Create Success',
            'pesan' => 'Document Visit Successfully Created',
            'swalFlashIcon' => 'success',
        ];
        return redirect()->route('visit.index')->with('flashData', $flashData);
    }

    public function update(Request $request, $id)
    {
        if ($request->status_visit == 'Cancel') {
            $status = 0;
        } elseif ($request->status_visit == 'Done Visit') {
            $status = 1;
        } else {
            $status = 2;
        }

        $nameParts = explode(' ', $request->customer_first_name);
        $firstName = array_shift($nameParts);
        $lastName  = implode(' ', $nameParts);

        // Jika lastName kosong, gunakan firstName sebagai lastName
        if (empty($lastName)) {
            $lastName = $firstName;
        }

        $data = [
            'first_name'   => $firstName,
            'last_name'    => $lastName,
            'email'        => $request->customer_email,
            'phone_number' => $request->customer_phone,
            'visit_date' => $request->date_visit,
        ];

        if ($request->status_visit !== null) {
            $data['status_docs'] = $status;
        }

        VisitDocsModel::where('id', $id)->update($data);

        $flashData = [
            'judul' => 'Edit Success',
            'pesan' => 'Document Visit Edited Successfully',
            'swalFlashIcon' => 'success',
        ];
        return redirect()->route('visit.index')->with('flashData', $flashData);
    }

    public function generateEnglishPDF(Request $request)
    {
        // Data
        $data = [
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'property' => $request->properties,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'visit_date' => Carbon::parse($request->visit_date)->format('d F, Y'),
            'agentData' => User::where('reference_code', $request->internal_reference)
                ->select('name', 'email')
                ->first(),
        ];

        // SET OPTION lebih dulu
        Pdf::setOption('isHtml5ParserEnabled', true);
        Pdf::setOption('isPhpEnabled', true);

        // Load view
        $pdf = Pdf::loadView('admin.docs.visit.pdf.english.english-pdf', $data)
            ->setPaper('A4', 'portrait');


        return $pdf->stream('test.pdf');
    }

    public function destroy($id)
    {
        VisitDocsModel::destroy($id);

        $flashData = [
            'judul' => 'Delete Success',
            'pesan' => 'Document Visit Deleted Successfully',
            'swalFlashIcon' => 'success',
        ];

        return response()->json($flashData);
    }
}
