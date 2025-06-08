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
        $data['visit_docs'] = VisitDocsModel::where('visit_docs.reference_code', Auth::user()->reference_code)
            ->select(
                'visit_docs.id',
                'visit_docs.first_name',
                'visit_docs.last_name',
                'visit_docs.email',
                'visit_docs.phone_number',
            )
            ->get();

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

        // dd($data['visit_docs']);

        return view('admin.docs.visit.index', $data);
    }

    public function create()
    {
        $dataClient = ClientModel::where('reference_code', Auth::user()->reference_code)
            ->select('first_name', 'last_name', 'email', 'phone_number')
            ->get();

        $clientEmails = $dataClient->pluck('email')->toArray();
        $rawDataLeads = PropertyLeadsModel::where('agent_code', Auth::user()->reference_code)
            ->select('cust_name', 'cust_email', 'cust_telp')
            ->get();

        $finalData = [];
        foreach ($dataClient as $client) {
            $finalData[] = [
                'first_name'   => $client->first_name,
                'last_name'    => $client->last_name,
                'email'        => $client->email,
                'phone_number' => $client->phone_number,
            ];
        }
        foreach ($rawDataLeads as $lead) {
            if (!in_array($lead->cust_email, $clientEmails)) {
                $nameParts = explode(' ', $lead->cust_name);
                $firstName = array_shift($nameParts);
                $lastName  = implode(' ', $nameParts);

                $finalData[] = [
                    'first_name'   => $firstName,
                    'last_name'    => $lastName,
                    'email'        => $lead->cust_email,
                    'phone_number' => $lead->cust_telp,
                ];
            }
        }

        $data['data_property'] = PropertiesModel::where('internal_reference', Auth::user()->reference_code)
            ->select(
                'properties.id',
                'properties.id as propertyId',
                'properties.property_code',
                'properties.property_name',
                'properties.property_address',
                'properties.region',
                'properties.sub_region',
                'property_financial.selling_price_idr',
                'property_financial.selling_price_usd',
            )
            ->join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
            ->with(['featuredImage' => function ($query) {
                $query->where('is_featured', 1);
            }])
            ->get();

        $data['data_client'] = $finalData;

        // dd($data['data_client']);

        return view('admin.docs.visit.create', $data);
    }

    public function store(Request $request)
    {
        $dataClient = explode('||', $request->input('dataClients'));

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
            'reference_code' => Auth::user()->reference_code
        ]);

        foreach ($request->propertyId as $idProperty) {
            VisitPropertyDocsModel::create([
                'docs_visit_id' => $docsVisit->id,
                'property_id' => $idProperty,
            ]);
        }

        $flashData = [
            'judul' => 'Create Success',
            'pesan' => 'Document Visit Successfully Created',
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
}
