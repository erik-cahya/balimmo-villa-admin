@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">

        <!-- ========== Page Title Start ========== -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="fw-semibold mb-0">Customer Overview</h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Customers</a></li>
                        <li class="breadcrumb-item active">Customer Overview</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- ========== Page Title End ========== -->

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex align-items-center my-3 gap-3">
                            <img src="{{ asset('admin') }}{{ $profile->profile == null ? '/assets/images/users/avatar-2.jpg' : '/profile-image/' . $profile->reference_code . '/' . $profile->profile }}" alt="" class="rounded-circle avatar-xl img-thumbnail" style="object-fit: cover">
                            <div>
                                <h3 class="fw-semibold mb-1">{{ $profile->name }}</h3>
                                <a href="#!" class="link-primary fw-medium fs-14">{{ $profile->tagline }}</a>
                            </div>

                        </div>
                        <div class="d-flex align-items-start justify-content-between mt-3 flex-wrap gap-3">
                            <div>
                                <a href="mailto:{{ $profile->email }}" class="btn btn-primary"><i class="ri-mail-fill"></i> Email Us</a>
                                <a href="#!" class="btn btn-outline-primary"><i class="ri-phone-fill"></i> Phone</a>
                                @if ($profile->status === 0)
                                    <input type="hidden" class="propertyId" value="{{ $profile->id }}">
                                    {{-- <a href="#!" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#resetPasswordModal"><iconify-icon icon="mdi:account-reactivate-outline" class="fs-18 align-middle"></iconify-icon> Reactivate Account</a> --}}
                                    <button type="button" class="btn btn-outline-primary deleteButton" data-nama="{{ $profile->name }}"><iconify-icon icon="mdi:account-reactivate-outline" class="fs-18 align-middle"></iconify-icon> Reactivate Account</button>
                                @else
                                    <a href="#!" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#resetPasswordModal"><i class="ri-key-fill"></i> Reset Password</a>
                                @endif
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="resetPasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('agent.changePassword') }}" method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Reset User Password</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="reference_code" value="{{ $profile->reference_code }}">
                                            <x-form-input className="col-lg-12" type="text" name="password" label="Input New Password" />
                                            <x-form-input className="col-lg-12" type="text" name="password_confirmation" label="Confirm Password" />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </div>

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul class="mb-0">
                                                    @foreach ($errors->all() as $message)
                                                        <li>{{ $message }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                </form>
                            </div>
                        </div>
                        <!-- /* Modal -->

                    </div>

                    <div class="row my-4">
                        <div class="col-lg-2 mt-2">
                            <p class="text-dark fw-semibold fs-16 mb-1">Email Address :</p>
                            <p class="mb-0">{{ $profile->email == null ? '-' : $profile->email }}</p>
                        </div>

                        <div class="col-lg-2 mt-2">
                            <p class="text-dark fw-semibold fs-16 mb-1">Reference Code :</p>
                            <p class="mb-0">{{ $profile->reference_code }}</p>
                        </div>

                        <div class="col-lg-2 mt-2">
                            <p class="text-dark fw-semibold fs-16 mb-1">Phone Number :</p>
                            <p class="mb-0">{{ $profile->phone_number == null ? '-' : $profile->phone_number }}</p>
                        </div>

                        <div class="col-lg-3 mt-2">
                            <p class="text-dark fw-semibold fs-16 mb-1">Address :</p>
                            <p class="mb-0">{{ $profile->address == null ? '-' : $profile->address }}</p>
                        </div>

                        <div class="col-lg-3 mt-2">
                            <h4 class="card-title mb-2">Description :</h4>
                            <p class="mb-0">{{ $profile->description == null ? '-' : $profile->description }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <h4 class="card-title mb-2">Social Media :</h4>
                            <ul class="list-inline d-flex align-items-center mb-0 mt-3 gap-1">
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="btn btn-soft-primary avatar-sm d-flex align-items-center justify-content-center fs-20">
                                        <i class="ri-facebook-fill"></i>
                                    </a>
                                </li>

                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="btn btn-soft-danger avatar-sm d-flex align-items-center justify-content-center fs-20">
                                        <i class="ri-instagram-fill"></i>
                                    </a>
                                </li>

                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="btn btn-soft-info avatar-sm d-flex align-items-center justify-content-center fs-20">
                                        <i class="ri-twitter-fill"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="btn btn-soft-success avatar-sm d-flex align-items-center justify-content-center fs-20">
                                        <i class="ri-whatsapp-fill"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="btn btn-soft-warning avatar-sm d-flex align-items-center justify-content-center fs-20">
                                        <i class="ri-mail-fill"></i>
                                    </a>
                                </li>
                            </ul>
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
    </div>
@endsection

@push('scripts')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var resetModal = new bootstrap.Modal(document.getElementById('resetPasswordModal'));
                resetModal.show();
            });
        </script>
    @endif

    {{-- Sweet Alert --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Saat halaman sudah ready
            const deleteButtons = document.querySelectorAll('.deleteButton');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    let propertyName = this.getAttribute('data-nama');
                    let propertyId = this.parentElement.querySelector('.propertyId').value;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Reactivate agent " + propertyName + "?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, activate it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Kirim DELETE request manual lewat JavaScript
                            fetch('/agent/reactivate/' + propertyId, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    Swal.fire({
                                        title: data.judul,
                                        text: data.pesan,
                                        icon: data.swalFlashIcon,
                                    });

                                    // Optional: reload table / halaman
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1500);
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire('Error', 'Something went wrong!', 'error');
                                });
                        }
                    });
                });
            });
        });
    </script>

    {{-- /* End Sweet Alert --}}

@endpush
