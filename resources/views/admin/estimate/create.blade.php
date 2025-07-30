@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="fw-semibold mb-0">
                        <a href="/dashboard">
                            <iconify-icon icon="fa7-solid:angle-left" class="fs-18 align-middle"></iconify-icon>                        
                            Estimate your villa’s price
                        </a> 
                    </h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Estimate</li>
                    </ol>
                    
                </div>
                <p class="col-6">
                    Use this tool to estimate the price of the villa [NAME OF VILLA]. This price will allow to help the customer estimate the value of his good base on the leasehold and freehold, the sector, the surface and if it was all ready reniew.
                </p>
            </div>
        </div>

        {{-- -------------------------------------------------------------------------  --}}
        {{-- Land Information Form  --}}
        {{-- -------------------------------------------------------------------------  --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body row">
                        <x-form-input className="col-lg-4" type="text" name="property_name" label="Land Name" />
                        <x-form-input className="col-lg-4" type="text" name="property_name" label="Land Name" />
                        <x-form-input className="col-lg-4" type="text" name="property_name" label="Land Name" />
                    </div>
                </div>
            </div>        
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body row align-items-center">
                        <div class="col-4">
                            <label for="description" class="form-label">Type of land : </label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type_mandate" id="esstentials_mandate" value="Essentials Mandate" {{ old('type_mandate') == 'Essentials Mandate' ? 'checked' : '' }}>
                                <label class="form-check-label" for="esstentials_mandate">Leasehold</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type_mandate" id="booster_mandate" value="Booster Mandate" {{ old('type_mandate') == 'Booster Mandate' ? 'checked' : '' }}>
                                <label class="form-check-label" for="booster_mandate">Freehold</label>
                            </div>
                        </div>
                        <div class="col-8 gap-3 d-flex align-items-center" id="group_internal_reference">
                            <label for="internal_reference" class="">Lease finish in</label>
                            <input type="date" class="form-control" style="width: 150px" placeholder="End date">
                            <label for="">You still have [LENGHT_DURATION_IN_YEARS] years</label>
                        </div>
                    </div> 
                </div>
            </div>        
        </div>
    </div>
@endsection