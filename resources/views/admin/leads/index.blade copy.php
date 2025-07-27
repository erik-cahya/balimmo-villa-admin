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
<script src="{{ asset('admin/assets/js/flatpickr-min.js') }}"></script>

{{-- Modal Match Properties --}}
{{-- <script>
        $(document).ready(function() {
            $('.show-matching').on('click', function() {
                var leadId = $(this).data('lead-id');

                // Reset modal
                $('#criteriaInfo').empty();
                $('#propertiesData').empty();
                $('#modalLoading').show();
                $('#noProperties').hide();

                // AJAX
                $.get('/leads/' + leadId + '/matching-properties', function(response) {
                    $('#matchingPropertiesModalLabel').text('Matching Properties for Lead #' + leadId);

                    // Lead data
                    if (response.lead.length > 0) {
                        var criteriaHtml = '';
                        $.each(response.lead, function(index, lead) {
                            criteriaHtml += `
                        <div class="col-lg-6">
                            <div class="alert alert-info mb-3">
                                <strong>Criteria:</strong><br>
                                Budget: ${formatCurrency(lead.min_budget)} - ${formatCurrency(lead.max_budget)}<br>
                                Type Asset: ${lead.type_asset}<br>
                                Bedrooms: ${lead.min_bedroom} - ${lead.max_bedroom}
                            </div>
                        </div>
                    `;
                        });
                        $('#criteriaInfo').html(criteriaHtml);
                    }

                    // Properties data
                    if (response.properties.villa.length > 0) {
                        var propertiesHTML = '';
                        $.each(response.properties.villa, function(index, property) {
                            propertiesHTML += `
                        <div class="col-lg-6">
                            <div class="alert alert-info mb-3">
                                <strong>Properties Name:</strong> ${property.property_name}
                            </div>
                        </div>
                    `;
                        });
                        $('#propertiesData').html(propertiesHTML);
                    } else {
                        $('#noProperties').show();
                    }

                    $('#modalLoading').hide();
                });
            });

            function formatCurrency(amount) {
                if (!amount) return '-';
                return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
        });
    </script> --}}
{{-- End Modal Match Properties --}}

{{-- Match Properties 2 --}}
<script>
    $(document).ready(function() {
        $('.matching-container').each(function() {
            var container = $(this);
            var leadId = container.data('lead-id');

            // Show loading (optional)
            var loading = $('<div class="loading mb-3">Loading...</div>');
            container.prepend(loading);

            // AJAX
            $.get('/leads/' + leadId + '/matching-properties', function(response) {
                // Remove loading
                loading.remove();

                // Lead data
                if (response.lead.length > 0) {
                    var criteriaHtml = '';
                    $.each(response.lead, function(index, lead) {
                        criteriaHtml += `
                        <div class="alert alert-info mb-3">
                            <strong>Criteria:</strong><br>
                            Budget: ${formatCurrency(lead.min_budget)} - ${formatCurrency(lead.max_budget)}<br>
                            Type Asset: ${lead.type_asset}<br>
                            Bedrooms: ${lead.min_bedroom} - ${lead.max_bedroom}
                        </div>
                    `;
                    });
                    container.find('.criteriaInfo').html(criteriaHtml);
                }

                // Properties data
                if (response.properties.villa.length > 0) {
                    var propertiesHTML = '';
                    $.each(response.properties.villa, function(index, property) {
                        propertiesHTML += `
                        <div class="col-lg-6">
                            <div class="alert alert-info mb-3">
                                <strong>Properties Name:</strong> ${property.property_name}
                            </div>
                        </div>
                    `;
                    });
                    container.find('.propertiesData').html(propertiesHTML);
                } else {
                    container.find('.noProperties').show();
                }
            });
        });

        function formatCurrency(amount) {
            if (!amount) return '-';
            return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    });
</script>

{{-- End Match Properties 2 --}}

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
                let customerID = this.parentElement.querySelector('.customerID').value;
                console.log(propertyName);

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
                        fetch('/leadsSingle/' + customerID, {
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
    document.addEventListener('DOMContentLoaded', function() {

        const cleaveFields = [{
            id: '#villa_min_budget_idr',
            options: {
                prefix: 'IDR '
            }
        }, {
            id: '#villa_max_budget_idr',
            options: {
                prefix: 'IDR '
            }
        }, {
            id: '#land_min_budget_idr',
            options: {
                prefix: 'IDR '
            }
        }, {
            id: '#land_max_budget_idr',
            options: {
                prefix: 'IDR '
            }
        }, {
            id: '#land_min_budget_usd',
            options: {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand',
                prefix: '$ ',
                noImmediatePrefix: true,
                numeralDecimalMark: '.',
                delimiter: ',',
            }
        }, {
            id: '#land_max_budget_usd',
            options: {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand',
                prefix: '$ ',
                noImmediatePrefix: true,
                numeralDecimalMark: '.',
                delimiter: ',',
            }
        }, ];

        cleaveFields.forEach(field => {
            const el = document.querySelector(field.id);
            if (el) {
                new Cleave(el, {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand',
                    prefix: '$ ',
                    noImmediatePrefix: true,
                    numeralDecimalMark: ',',
                    delimiter: '.',
                    ...field.options
                });
            } else {
                console.warn(`Element not found: ${field.id}`);
            }
        });
    });
</script>
{{-- /* End Currency Format --}}

{{-- Toggle Villa/Land Checkbox --}}
<script>
    function toggleSections() {
        // Ambil semua checkbox villa dan land yang tercentang
        const selected_villas = $('input[name="type_properties_villa"]:checked');
        const selected_lands = $('input[name="type_properties_land"]:checked');

        // Sembunyikan semua section terlebih dahulu
        $('.villa-section').hide();
        $('.land-section').hide();

        // Tampilkan section villa yang sesuai dengan checkbox tercentang
        selected_villas.each(function() {
            const index = $(this).data('index'); // Asumsikan ada data-index
            $(`.villa-section[data-index="${index}"]`).show();
        });

        // Tampilkan section land yang sesuai dengan checkbox tercentang
        selected_lands.each(function() {
            const index = $(this).data('index'); // Asumsikan ada data-index
            $(`.land-section[data-index="${index}"]`).show();
        });
    }

    // Jalankan saat dokumen siap
    $(document).ready(function() {
        toggleSections(); // ✅ untuk handle saat page load

        // ✅ Event listener saat checkbox berubah
        $('input[name="type_properties_villa"]').on('change', toggleSections);
        $('input[name="type_properties_land"]').on('change', toggleSections);
    });
</script>

{{-- Flatpickr --}}
<script>
    $("#ready_buy_villa").flatpickr({
        dateFormat: "d F, Y"
    });

    $("#ready_buy_land").flatpickr({
        dateFormat: "d F, Y"
    });
</script>
{{-- /* End Flatpickr --}}
@endpush