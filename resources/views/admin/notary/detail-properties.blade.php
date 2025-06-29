@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div>
                        <h4 class="fw-semibold mb-0">Agent Properties List</h4>
                        <p class="mb-0">Show {{ $agent_properties->count() }} Properties</p>
                    </div>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Agents</a></li>
                        <li class="breadcrumb-item active">Agent List</li>
                    </ol>
                </div>
            </div>
        </div>

        @if ($agent_properties->count() == 0)
            <div class="d-flex justify-content-center">
                <p>No Properites Found</p>
            </div>
        @endif
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="row">
                    @foreach ($agent_properties as $properties)
                        <div class="col-lg-3 col-md-6">
                            <div class="card overflow-hidden">
                                <div class="position-relative">
                                    <img src="{{ asset($properties->featuredImage->image_path) }}" alt="" class="img-fluid rounded-top">
                                    <span class="position-absolute start-0 top-0 p-1">
                                        <button type="button" class="btn btn-warning avatar-sm d-inline-flex align-items-center justify-content-center fs-20 text-light rounded"><iconify-icon icon="solar:bookmark-broken"></iconify-icon></button>
                                    </span>
                                    <span class="position-absolute end-0 top-0 p-1">
                                        <span class="badge bg-success fs-13 text-white">For Rent</span>
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar bg-light rounded">
                                            <iconify-icon icon="solar:home-bold-duotone" class="fs-24 text-primary avatar-title"></iconify-icon>
                                        </div>
                                        <div>
                                            <a href="{{ route('properties.details', $properties->property_slug) }}" class="text-dark fw-medium fs-16">{{ $properties->property_name }}</a>
                                            <p class="text-muted mb-0">{{ $properties->property_address }}</p>
                                        </div>
                                    </div>
                                    <div class="row g-2 mt-2">
                                        <div class="col-lg-4 col-4">
                                            <span class="badge bg-light-subtle text-muted fs-12 border">
                                                <span class="fs-16"><iconify-icon icon="solar:bed-broken" class="align-middle"></iconify-icon></span>
                                                {{ $properties->bedroom }} Beds
                                            </span>
                                        </div>
                                        <div class="col-lg-4 col-4">
                                            <span class="badge bg-light-subtle text-muted fs-12 border">
                                                <span class="fs-16"><iconify-icon icon="solar:bath-broken" class="align-middle"></iconify-icon></span>
                                                {{ $properties->bathroom }} Bath
                                            </span>
                                        </div>
                                        <div class="col-lg-4 col-4">
                                            <span class="badge bg-light-subtle text-muted fs-12 border">
                                                <span class="fs-16"><iconify-icon icon="guidance:swimming-pool" class="align-middle"></iconify-icon></span>
                                                {{ $properties->pool_area }} m²
                                            </span>
                                        </div>
                                        <div class="col-lg-4 col-4">
                                            <span class="badge bg-light-subtle text-muted fs-12 border">
                                                <span class="fs-16"><iconify-icon icon="solar:double-alt-arrow-up-broken" class="align-middle"></iconify-icon></span>
                                                {{ $properties->villa_area }} m²
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer bg-light-subtle d-flex justify-content-between align-items-center border-top">
                                    {{-- <p class="fw-medium text-dark fs-16 mb-0">IDR {{ number_format($properties->selling_price_idr, 2, ',', '.') }} </p> --}}
                                    <p class="fw-medium text-dark fs-16 mb-0">{{ $properties->formatted_price }} </p>
                                    <div>
                                        <a href="{{ route('properties.details', $properties->property_slug) }}" class="link-primary fw-medium">Detail Property <i class="ri-arrow-right-line align-middle"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="border-top p-3">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end mb-0">
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    </div>
@endsection
