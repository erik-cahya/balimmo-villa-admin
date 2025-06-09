<?php

namespace App\Http\Controllers\Admin\Docs;

use App\Http\Controllers\Controller;
use App\Models\VisitDocsModel;
use App\Models\VisitPropertyDocsModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferToPurchaseController extends Controller
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

        return view('admin.docs.offer-purchase.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.docs.offer-purchase.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

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
        //
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
}
