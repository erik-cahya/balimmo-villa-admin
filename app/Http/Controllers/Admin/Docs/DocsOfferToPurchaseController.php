<?php

namespace App\Http\Controllers\Admin\Docs;

use App\Http\Controllers\Controller;
use App\Models\ClientModel;
use App\Models\OfferingDocsModel;
use App\Models\PropertiesModel;
use App\Models\PropertyLeadsModel;
use App\Models\VisitDocsModel;
use App\Models\VisitPropertyDocsModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;


class DocsOfferToPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'Master') {
            $data['offering_docs'] = OfferingDocsModel::join('property_leads', 'property_leads.id', '=', 'offering_docs.client_id')
                ->join('properties', 'properties.id', '=', 'offering_docs.properties_id')
                ->select(
                    'offering_docs.*',
                    'properties.property_name',
                    'property_leads.cust_name as custName',
                    'property_leads.cust_email as email',
                    'property_leads.cust_telp',
                )
                ->get();
        } else {
            $data['offering_docs'] = OfferingDocsModel::where('offering_docs.reference_code', Auth::user()->reference_code)
                ->join('property_leads', 'property_leads.id', '=', 'offering_docs.client_id')
                ->join('properties', 'properties.id', '=', 'offering_docs.properties_id')
                ->select(
                    'offering_docs.*',
                    'properties.property_name',
                    'property_leads.cust_name as custName',
                    'property_leads.cust_email as email',
                    'property_leads.cust_telp',
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
        $data['data_prospect'] = PropertyLeadsModel::where('agent_code', Auth::user()->reference_code)->where('prospect_status', 1)->get();

        // dd($data['data_prospect']);

        return view('admin.docs.offer-purchase.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'client_nationality' => 'required',
            'client_passport_number' => 'required',
            'offer_validity' => 'required',
            'price_deposit_ammount' => 'required',
        ]);

        if ($request->financing_terms === 'Cash Purchase') {
            $request->loan_ammount == null;
            $request->bank_name == null;
            $request->approval_deadline == null;
        } else {
            $request->validate([
                'financing_terms' => 'required',
                'loan_ammount' => 'required',
                'bank_name' => 'required',
                'approval_deadline' => 'required',
            ]);
        }


        PropertyLeadsModel::where('id', $request->id_client)->update(['docs_status' => 2]);

        // dd($request->all());
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

        // dd($leads);

        $flashData = [
            'judul' => 'Create Docs Success',
            'pesan' => 'New Offering Docs successfully created',
            'swalFlashIcon' => 'success',
        ];
        return redirect()->route('offer-purchase.index')->with('flashData', $flashData);
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

        $dataOffering = OfferingDocsModel::where('id', $id)->value('client_id');
        PropertyLeadsModel::where('id', $dataOffering)->update(['docs_status' => null]);

        OfferingDocsModel::destroy($id);

        $flashData = [
            'judul' => 'Delete Success',
            'pesan' => 'Offering Docs Deleted Successfully',
            'swalFlashIcon' => 'success',
        ];

        return response()->json($flashData);
    }

    public function generateEnglishPDF(Request $request)
    {

        $data['docs_offering'] = OfferingDocsModel::where('offering_docs.id', $request->offering_id)
            ->join('property_leads', 'property_leads.id', '=', 'offering_docs.client_id')
            ->join('properties', 'properties.id', '=', 'offering_docs.properties_id')
            ->join('property_legal', 'property_legal.properties_id', '=', 'properties.id')
            ->join('users', 'users.reference_code', '=', 'offering_docs.reference_code')
            ->select(
                'offering_docs.*',

                'property_leads.cust_name',
                'property_leads.cust_email as email',
                'property_leads.cust_telp as phone_number',

                'properties.property_name',
                'properties.property_address',
                'properties.region',
                'properties.sub_region',
                'properties.total_land_area',
                'properties.villa_area',
                'properties.bedroom',
                'properties.bathroom',
                'properties.pool_area',

                'property_legal.legal_status',
                'property_legal.company_name',
                'property_legal.rep_first_name',
                'property_legal.rep_last_name',
                'property_legal.purchase_date',
                'property_legal.phone as rep_phone',
                'property_legal.email as rep_email',

                'users.name as agentName'



            )
            ->first();

        // dd($data['docs_offering']);

        if ($data['docs_offering']->legal_status == 'Leasehold') {

            $tanggalAkhir = Carbon::parse($data['docs_offering']->end_date);
            $tanggalAwal = Carbon::now();
            $sisaHari = $tanggalAwal->diffInDays($tanggalAkhir, false);
            $data['docs_offering']->rest_times = $sisaHari . ' Days';

            // dd($sisaHari);
        }
        $data['docs_offering']->usdRates = $this->getUSDtoIDRRate();

        // dd($data['docs_offering']);

        // dd($this->getUSDtoIDRRate());


        // Tambahkan properti tambahan lainnya

        $nameParts = explode(' ', $data['docs_offering']->cust_name);
        $firstName = array_shift($nameParts);
        $lastName  = implode(' ', $nameParts);

        if (empty($lastName)) {
            $lastName = $firstName;
        }
        $data['docs_offering']->first_name = $firstName;
        $data['docs_offering']->last_name = $lastName;


        // SET OPTION lebih dulu
        Pdf::setOption('isHtml5ParserEnabled', true);
        Pdf::setOption('isPhpEnabled', true);

        // Load view
        $pdf = Pdf::loadView('admin.docs.offer-purchase.pdf.english.pdf-offer-purchase', $data)
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
                'properties.property_address',

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

    private function getUSDtoIDRRate()
    {
        return Cache::remember('usd_to_idr_rate', now()->addHours(1), function () {
            try {
                $response = Http::get('https://api.exchangerate-api.com/v4/latest/USD');
                return $response['rates']['IDR'] ?? 15000;
            } catch (\Exception $e) {
                return 15000;
            }
        });
    }
}
