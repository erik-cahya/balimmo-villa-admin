@extends('admin.layouts.master')
@push('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dataTable.min.css') }}">

    <style>
        .dataTables_filter input {
            border: 1px solid #eaedf1 !important;
            /* border: 1px solid red; */
            padding: 6px;
            border-radius: 5px;
        }

        .dataTables_wrapper {
            padding: 1rem;
        }

        .dataTable {
            margin-top: 3rem !important;
        }

        .paging_simple_numbers {
            /* background-color: red; */
            /* #063436 */
        }
    </style>
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.min.js') }}"></script>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="fw-semibold mb-0">Property Leads </h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Leads</a></li>
                        <li class="breadcrumb-item active">Leads Property List</li>
                    </ol>
                </div>
            </div>
        </div>

        {{-- Specific Properties --}}
        @include('admin.leads.leads-components.specific-properties-list')

        {{-- Match Properties --}}
        @include('admin.leads.leads-components.match-properties-list')

    </div>
@endsection
@push('scripts')
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/cleave.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/cleave-phone.us.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            $('#specificPropertyTable').DataTable();
            $('#seePropertiesTable-' + this.getAttribute('data-nama')).DataTable();
        });
    </script>
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
                    console.log(propertyId);

                    const rowToDelete = this.closest('tr');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete leads " + propertyName + "?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Kirim DELETE request manual lewat JavaScript
                            fetch('/leads/' + propertyId, {
                                    method: 'DELETE',
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

                                    // Hapus baris dari DOM tanpa reload halaman
                                    if (rowToDelete) {
                                        rowToDelete.remove();
                                    }

                                    // Atau jika menggunakan DataTables, refresh tabel:
                                    // $('#table-id').DataTable().ajax.reload();
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire('Error', 'Something went wrong!', 'error');
                                });
                        }
                    });
                });
            });

            // Single Delete
            const deleteButtonSingle = document.querySelectorAll('.deleteButtonSingle');

            deleteButtonSingle.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    let propertyName = this.getAttribute('data-nama');
                    let leadsId = this.parentElement.querySelector('.leadsId').value;
                    console.log(leadsId);

                    const rowToDelete = this.closest('tr');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete leads " + propertyName + "?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Kirim DELETE request manual lewat JavaScript
                            fetch('/leadsSingle/' + leadsId, {
                                    method: 'DELETE',
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

                                    // Hapus baris dari DOM tanpa reload halaman
                                    if (rowToDelete) {
                                        rowToDelete.remove();
                                    }

                                    // Atau jika menggunakan DataTables, refresh tabel:
                                    // $('#table-id').DataTable().ajax.reload();
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

    {{-- Currency Format --}}
    <script>
        const cleaveFields = [{
            id: '#leads_budget11',
            options: {
                prefix: 'IDR '
            }
        }];

        cleaveFields.forEach(field => {
            new Cleave(field.id, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand',
                prefix: '$ ',
                noImmediatePrefix: true,
                numeralDecimalMark: ',',
                delimiter: '.',
                ...field.options // spread operator untuk custom config
            });
        });
    </script>

    <script>
        function toggleSections() {
            const selected = $('input[name="type_properties"]:checked').val();

            if (selected === 'Villa') {
                $('#villa_section').show();
                $('#land_section').hide();
            } else if (selected === 'Land') {
                $('#villa_section').hide();
                $('#land_section').show();
            } else {
                // jika tidak ada yg dipilih
                $('#villa_section').hide();
                $('#land_section').hide();
            }
        }

        $(document).ready(function() {
            toggleSections(); // ✅ untuk handle saat page pertama kali muncul

            $('input[name="type_properties"]').on('change', function() {
                toggleSections(); // ✅ untuk handle saat user mengganti pilihan
            });
        });
    </script>
@endpush
