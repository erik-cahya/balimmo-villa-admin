@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">

        <!-- ========== Page Title Start ========== -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="fw-semibold mb-0">Profile Overview</h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Profiles</a></li>
                        <li class="breadcrumb-item active">Profile Overview</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- ========== Page Title End ========== -->

        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex align-items-center my-3 gap-3">
                            <img src="{{ asset('admin') }}{{ Auth::user()->profile == null ? '/assets/images/users/dummy-avatar.jpg' : '/profile-image/' . Auth::user()->reference_code . '/' . Auth::user()->profile }}" alt="" class="rounded-circle avatar-xl img-thumbnail" style="object-fit: cover">
                            <div>
                                <h3 class="fw-semibold mb-1">{{ $profile->name }} </h3>
                                <span class="badge bg-primary fs-12">{{ Auth::user()->reference_code }}</span>
                                <a href="#!" class="link-primary fw-medium fs-14">{{ $profile->tagline }}</a>
                            </div>

                        </div>
                        <div class="d-flex align-items-start justify-content-between mt-3 flex-wrap gap-3">
                            <div>
                                <a href="mailto:{{ $profile->email }}" class="btn btn-primary"><i class="ri-mail-fill"></i> Email Us</a>
                                <a href="#!" class="btn btn-outline-primary"><i class="ri-phone-fill"></i> Phone</a>
                            </div>
                        </div>

                        <div class="row my-4">
                            <div class="col-lg-3">
                                <p class="text-dark fw-semibold fs-16 mb-1">Email Address :</p>
                                <p class="mb-0">{{ $profile->email == null ? '-' : $profile->email }}</p>
                            </div>
                            <div class="col-lg-3">
                                <p class="text-dark fw-semibold fs-16 mb-1">Phone Number :</p>
                                <p class="mb-0">{{ $profile->phone_number == null ? '-' : $profile->phone_number }}</p>
                            </div>
                            <div class="col-lg-4">
                                <p class="text-dark fw-semibold fs-16 mb-1">Address :</p>
                                <p class="mb-0">{{ $profile->address == null ? '-' : $profile->address }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-8">
                                <h4 class="card-title mb-2">Description :</h4>
                                <p class="mb-0">{{ $profile->description == null ? '-' : $profile->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="rounded border p-2">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar bg-success rounded bg-opacity-10">
                                            <iconify-icon icon="solar:home-2-bold" class="fs-28 text-success avatar-title"></iconify-icon>
                                        </div>
                                        <div>
                                            <p class="text-dark fw-semibold fs-16 mb-0">Total Property</p>
                                            <p class="mb-0">{{ $propertiesCount }} Property</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="rounded border p-2">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar bg-warning rounded bg-opacity-10">
                                            <iconify-icon icon="solar:home-bold" class="fs-28 text-warning avatar-title"></iconify-icon>
                                        </div>
                                        <div>
                                            <p class="text-dark fw-semibold fs-16 mb-0">Freehold Property</p>
                                            <p class="mb-0">{{ $freeholdCount }} Property</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="rounded border p-2">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar bg-primary rounded bg-opacity-10">
                                            <iconify-icon icon="solar:money-bag-bold" class="fs-28 text-primary avatar-title"></iconify-icon>
                                        </div>
                                        <div>
                                            <p class="text-dark fw-semibold fs-16 mb-0">Leasehold Property</p>
                                            <p class="mb-0">{{ $leaseholdCount }} Property</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-12">
                <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header text-bg-primary">
                            <h4 class="card-title"><i class="ri-pencil-line"></i> Edit Data</h4>
                        </div>
                        <div class="card-body">

                            <input type="hidden" name="reference_code" value="{{ $profile->reference_code }}">
                            <x-form-input className="" type="text" name="name" label="Name" value="{{ $profile->name }}" />
                            <x-form-input className="" type="text" name="tagline" label="Tagline" value="{{ $profile->tagline }}" />
                            <div class="col-lg-12 mb-3" id="group_description">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter address">{{ old('description', $profile->description) }}</textarea>
                            </div>

                            <x-form-input className="" type="text" name="email" label="Email" value="{{ $profile->email }}" />
                            <x-form-input className="" type="text" name="phone" label="Phone" value="{{ $profile->phone_number }}" />

                            <div class="col-lg-12 mb-3" id="group_address">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter address">{{ old('address', $profile->address) }}</textarea>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label for="photo_profile" class="form-label">Upload Photo Profile</label>
                                <input type="file" id="photo_profile" name="photo_profile" class="form-control" placeholder="">
                            </div>

                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    @endsection
