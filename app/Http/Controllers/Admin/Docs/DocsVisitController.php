<?php

namespace App\Http\Controllers\Admin\Docs;

use App\Http\Controllers\Controller;
use App\Models\ClientModel;
use App\Models\PropertiesModel;
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
            ->join('client', 'client.id', '=', 'visit_docs.client_id')
            ->select(
                'visit_docs.id',
                'client.first_name',
                'client.last_name',
                'client.email',
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

        $data['data_client'] = ClientModel::where('reference_code', Auth::user()->reference_code)->get();

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


        return view('admin.docs.visit.create', $data);
    }

    public function store(Request $request)
    {
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
            'client_id' => $request->dataClients,
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



    // public function generateEnglishPDF()
    // {
    //     $pdf = PDF::loadView('admin.docs.visit.pdf.english.english-pdf')->setPaper('A4', 'portrait');
    //     return $pdf->stream('docs.pdf');
    // }


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



    // public function storeSignature(Request $request)
    // {
    //     $signatureData = $request->input('signature');

    //     // Simpan file gambar (opsional, kalau mau simpan di storage)
    //     $image = str_replace('data:image/png;base64,', '', $signatureData);
    //     $image = str_replace(' ', '+', $image);
    //     $imageName = 'signature_' . time() . '.png';
    //     Storage::disk('public')->put('signatures/' . $imageName, base64_decode($image));

    //     // Kirim ke PDF view
    //     $pdf = Pdf::loadView('pdf.document', [
    //         'signature' => $signatureData,
    //     ]);

    //     return $pdf->download('signed_document.pdf');
    // }
}
