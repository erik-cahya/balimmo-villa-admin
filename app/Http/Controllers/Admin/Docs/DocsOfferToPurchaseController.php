<?php

namespace App\Http\Controllers\Admin\Docs;

use App\Http\Controllers\Controller;
use App\Models\ClientModel;
use App\Models\OfferingDocsModel;
use App\Models\PropertiesModel;
use App\Models\VisitDocsModel;
use App\Models\VisitPropertyDocsModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocsOfferToPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['visit_docs'] = VisitDocsModel::where('visit_docs.reference_code', Auth::user()->reference_code)
            ->select(
                'visit_docs.id',
                'visit_docs.first_name',
                'visit_docs.last_name',
                'visit_docs.email',
                'visit_docs.phone_number',
                'visit_docs.status_docs',
                'visit_docs.visit_date',
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

        if (Auth::user()->role == 'Master') {
            $data['offering_docs'] = OfferingDocsModel::join('client', 'client.id', '=', 'offering_docs.client_id')
                ->join('properties', 'properties.id', '=', 'offering_docs.properties_id')
                ->select(
                    'offering_docs.*',
                    'properties.property_name',
                    'client.first_name',
                    'client.last_name',
                    'client.email',
                    'client.phone_number',
                )
                ->get();
        } else {
            $data['offering_docs'] = OfferingDocsModel::where('offering_docs.reference_code', Auth::user()->reference_code)
                ->join('client', 'client.id', '=', 'offering_docs.client_id')
                ->join('properties', 'properties.id', '=', 'offering_docs.properties_id')
                ->select(
                    'offering_docs.*',
                    'properties.property_name',
                    'client.first_name',
                    'client.last_name',
                    'client.email',
                    'client.phone_number',
                )
                ->get();
        }

        return view('admin.docs.offer-purchase.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['data_property'] = PropertiesModel::where('internal_reference', Auth::user()->reference_code)->get();
        $data['data_client'] = ClientModel::where('reference_code', Auth::user()->reference_code)->get();


        return view('admin.docs.offer-purchase.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'client_nationality' => 'required',
            'client_passport_number' => 'required',
            'offer_validity' => 'required',
        ]);

        if ($request->financing_terms === 'Cash Purchase') {
            $request->loan_ammount == null;
            $request->bank_name == null;
            $request->approval_deadline == null;
        }

        OfferingDocsModel::create([
            'reference_code' => Auth::user()->reference_code,
            'properties_id' => $request->id_property,
            'client_id' => $request->id_client,
            'client_passport_number' => $request->client_passport_number,
            'client_nationality' => $request->client_nationality,
            'idr_price' => $this->convertToInteger($request->price_idr_price),
            'usd_price' => (float)str_replace(['USD', "\u{A0}", ',', ' '], '', $request->price_usd_price),
            'deposit_ammount' => $this->convertToInteger($request->price_deposit_ammount),
            'satisfactory_technical_inspection' => $request->satisfactory_technical_inspection === 'on' ? 1 : null,
            'loan_approval' => $request->approval_loan === 'on' ? 1 : null,
            'legal_due_diligence' => $request->legal_due_diligence === 'on' ? 1 : null,
            'others_contingency' => $request->others_contingency,
            'financing_terms' => $request->financing_terms,
            'loan_ammount' => $request->loan_ammount == null ? null : $this->convertToInteger($request->loan_ammount),
            'bank_name' => $request->bank_name,
            'approval_deadline' => $request->approval_deadline == null ? null : $this->dateConversion($request->approval_deadline),
            'offer_validity' => $this->dateConversion($request->offer_validity),
        ]);

        $flashData = [
            'judul' => 'Create Docs Success',
            'pesan' => 'New Offering Docs successfully created',
            'swalFlashIcon' => 'success',
        ];
        return redirect()->route('offer-purchase.create')->with('flashData', $flashData);
    }
    // USD 2207531
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        OfferingDocsModel::destroy($id);

        $flashData = [
            'judul' => 'Delete Success',
            'pesan' => 'Offering Docs Deleted Successfully',
            'swalFlashIcon' => 'success',
        ];

        return response()->json($flashData);
    }

    public function generateEnglishPDF()
    {
        // SET OPTION lebih dulu
        Pdf::setOption('isHtml5ParserEnabled', true);
        Pdf::setOption('isPhpEnabled', true);

        // Load view
        $pdf = Pdf::loadView('admin.docs.offer-purchase.pdf.english.pdf-offer-purchase')
            ->setPaper('A4', 'portrait');


        return $pdf->stream('test.pdf');
    }

    public function getPropertiesAjax($id)
    {
        $propertyData = PropertiesModel::where('properties.id', $id)
            ->join('property_financial', 'property_financial.properties_id', '=', 'properties.id')
            ->join('property_legal', 'property_legal.properties_id', '=', 'properties.id')
            ->select(
                'properties.id',
                'properties.property_name',
                'properties.property_name',
                'properties.bathroom',
                'properties.bedroom',

                'property_legal.legal_status',
                'property_legal.company_name',
                'property_legal.rep_first_name',
                'property_legal.rep_last_name',
                'property_legal.phone as rep_phone',
                'property_legal.email as rep_email',

                'property_financial.selling_price_idr',
                'property_financial.selling_price_usd',
            )
            ->first();

        if (!$propertyData) {
            return response()->json(['error' => 'Property not found'], 404);
        }

        $tanggalAkhir = Carbon::parse($propertyData->end_date);
        $tanggalAwal = Carbon::now();
        $sisaHari = $tanggalAwal->diffInDays($tanggalAkhir, false);

        // Tambahkan properti tambahan lainnya
        $propertyData->datasProperty = $sisaHari . ' Days';

        return response()->json(['data' => $propertyData]);
    }

    public function getClientsAjax($id)
    {
        $clientData = ClientModel::where('id', $id)
            ->first();

        return response()->json(['data' => $clientData]);
    }

    private function dateConversion($date)
    {
        return Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
    }

    private function convertToInteger($value)
    {
        return (int)preg_replace('/[^0-9]/', '', $value);
    }
}
