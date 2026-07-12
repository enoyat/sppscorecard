@extends('layouts.master')
@section('title')
    Maintenance
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        #example {
            font-size: 12px;
        }

        #example thead th {
            padding: 6px 8px;
            white-space: nowrap;
            vertical-align: middle;
            background: #f8f9fa;
        }

        #example tbody td,
        #example tbody th {
            padding: 4px 8px;
            vertical-align: middle;
        }

        #example .btn {
            padding: .20rem .45rem;
            font-size: 11px;
        }

        #example .badge {
            font-size: 10px;
        }

        .dataTables_wrapper .dataTables_filter input {
            margin-left: .5rem;
        }

        .dataTables_wrapper .dataTables_length select {
            width: 70px;
        }

        table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child,
        table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child {
            padding-left: 35px !important;
        }
    </style>
@endsection
@section('content')
    <!-- start page title -->
    @component('components.breadcrumb')
        @slot('li_1')
            Maintenance
        @endslot
        @slot('title')
            Maintenance Action
        @endslot
    @endcomponent
    <div class="row align-items-center">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                <div>
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('maintenance.index') }}" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="List"><i class="bx bx-list-ul"></i></a>
                        </li>

                    </ul>
                </div>
                <div>
                    <a href="javascript:void(0)" class="btn btn-info btn-sm btn-action"
                        data-url="{{ url('maintenance/formcreate') }}">
                        Add
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive mb-4" id="tablecontent">
        <table id="example" class="table table-sm table-striped table-hover table-bordered nowrap w-100 align-middle">
            <thead>
                <tr>
                    <TH SCOPE="COL">STATUS SPP</TH>
                    <TH SCOPE="COL">STATUS MECHANIC</TH>
                    <TH SCOPE="COL">STATUS CUSTOMER</TH>
                    <TH SCOPE="COL">MECHANIC</TH>
                    <TH SCOPE="COL">CODE UNIT</TH>
                    <TH SCOPE="COL">LIST FOTO</TH>
                    <TH SCOPE="COL">START DATE</TH>
                    <TH SCOPE="COL">DATE OF COMPLETION</TH>
                    <TH SCOPE="COL">SHIFT</TH>
                    <TH SCOPE="COL">ACTION PLAN</TH>
                    <TH SCOPE="COL">SPAREPARTS</TH>
                    <TH SCOPE="COL">HM</TH>
                    <TH SCOPE="COL">ACTION</TH>
                </tr>
            </thead>
            <tbody>
                @php $i=1; @endphp
                @foreach ($listactions as $key)
                    <tr>
                        <td scope="col">
                            @if ($key->statusspp == 'CLOSE')
                                <span class="badge badge-pill badge-soft-success font-size-12">{{ $key->statusspp }}</span>
                            @else
                                <span class="badge badge-pill badge-soft-danger font-size-12">{{ $key->statusspp }}</span>
                                @if (Auth::user()->roles_id == '1' || Auth::user()->roles_id == '4')
                                    <a class="btn btn-sm btn-info  btn-action"
                                        data-url="{{ URL('maintenance/formstatus?aid=spp&id=' . $key->id) }}"
                                        id="btnAction1"><i class=" fas fa-key"></i></a>
                                @endif
                            @endif
                        </td>
                        <td scope="col">
                            @if ($key->statusmekanik == 'CLOSE')
                                <span
                                    class="badge badge-pill badge-soft-success font-size-12">{{ $key->statusmekanik }}</span>
                            @else
                                <span
                                    class="badge badge-pill badge-soft-danger font-size-12">{{ $key->statusmekanik }}</span>
                            @endif
                        </td>
                        <td scope="col">
                            @if ($key->statuscustomer == 'CLOSE')
                                <span
                                    class="badge badge-pill badge-soft-success font-size-12">{{ $key->statuscustomer }}</span>
                            @else
                                <span
                                    class="badge badge-pill badge-soft-danger font-size-12">{{ $key->statuscustomer }}</span>
                                @if (Auth::user()->roles_id == '5' || Auth::user()->roles_id == '4')
                                    <a class="btn btn-sm btn-info  btn-action"
                                        data-url="{{ URL('maintenance/formstatus?aid=customer&id=' . $key->id) }}"
                                        id="btnAction1"><i class=" fas fa-key"></i></a>
                                @endif
                            @endif
                        </td>
                        <td scope="col">{{ $key->getuser->name }}</td>
                        <td scope="col">{{ $key->kdunit }}</td>
                        <td scope="col"><a href="{{ route('maintenance.listdokumen', $key->id) }}"
                                class="btn btn-warning btn-sm">List Foto</a></td>
                        <td scope="col">{{ $key->tanggalmulai }}</td>
                        <td scope="col">{{ $key->tanggalakhir }}</td>
                        <td scope="col">{{ $key->shift }}</td>
                        <td scope="col">{{ $key->actionplan }}</td>
                        <td scope="col">{{ $key->sparepart }}</td>
                        <td scope="col">{{ number_format($key->hm, 0) }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="javascript:void(0)" class="btn btn-info btn-sm btn-action"
                                    data-url="{{ url('maintenance/formaction?id=' . $key->id) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('maintenance.actiondestroy', $key->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- end table -->
    </div>
    <div class="modal fade" id="staticBackdrop" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Edit Maintenance
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center p-5">
                        <div class="spinner-border text-primary"></div>
                        <p class="mt-2">
                            Loading...
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true,
                pageLength: 25,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'Semua']
                ],
                order: [
                    [6, 'desc']
                ],
                language: {
                    search: "Cari :",
                    lengthMenu: "Tampilkan _MENU_ data",
                    zeroRecords: "Data tidak ditemukan",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                    paginate: {
                        previous: "←",
                        next: "→"
                    }
                }
            });
        });
        $(document).on('click', '.btn-action', function(e) {
            e.preventDefault();
            let url = $(this).data('url');
            $('.modal-body').html(`
        <div class="text-center p-5">
            <div class="spinner-border text-primary"></div>
            <p class="mt-2">Loading...</p>
        </div>
    `);
            const modal = new bootstrap.Modal(
                document.getElementById('staticBackdrop')
            );
            modal.show();
            $.ajax({
                url: url,
                type: 'GET',
                cache: false,
                success: function(res) {
                    $('.modal-body').html(res);
                },
                error: function(xhr) {
                    $('.modal-body').html(`
                <div class="alert alert-danger">
                    <h5>Terjadi Kesalahan</h5>
                    <hr>
                    <pre>${xhr.responseText}</pre>
                </div>
            `);
                }
            });
        });
    </script>
    <!-- end table responsive -->
@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="{{ URL::asset('build/libs/datatables/datatables.min.js') }}"></script>
    <!-- init js -->
    <script src="{{ URL::asset('build/js/pages/datatable-pages.init.js') }}"></script>
    <!-- Buttons examples -->
    {{-- <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script> --}}
    <script src="{{ URL::asset('build/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    {{-- <script src="{{ URL::asset('build/libs/pdfmake/vfs_fonts.js') }}"></script> --}}
    {{-- <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Responsive examples -->
<script src="{{ URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
</script> --}}
    <!-- Datatable init js -->
    <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
@endsection
