<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VillaModel;
use Illuminate\Support\Facades\DB;

class VillaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['data_villa'] = VillaModel::get();
        $data['data_villa_count'] = VillaModel::count();
        return view('admin.villa.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.villa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        VillaModel::create([
            'villa_name' => $request->villa_name,
            'price' => $request->price,
            'bedroom' => $request->bedroom,
            'sub_region' => $request->sub_region,
            'time' => $request->time,
        ]);

        return redirect()->route('villa.index');
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

