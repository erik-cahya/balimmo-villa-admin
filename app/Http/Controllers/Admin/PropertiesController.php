<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertiesFeatureModel;
use App\Models\PropertiesModel;
use Illuminate\Http\Request;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['data_property'] = PropertiesModel::get();
        $data['data_property_count'] = PropertiesModel::count();
        return view('admin.properties.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['features'] = PropertiesFeatureModel::all();
        // dd($data['features']);
        return view('admin.properties.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        PropertiesModel::create([
            'villa_name' => $request->villa_name,
            'price' => str_replace('.', '', $request->price),
            'bedroom' => $request->bedroom,
            'sub_region' => $request->sub_region,
        ]);

        return redirect()->route('properties.index');
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
}
