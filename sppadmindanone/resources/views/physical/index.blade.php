@extends('layouts.master')

@section('title')
    PHYSICAL
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
    @if (Session::get('roles_id') == 1 || Session::get('roles_id') == 5)
        <x-dashboard-filter :showPeriode="true" :showCBU="true" :showRegion="true" :showSite="true" :showForkliftType="false" />
        @push('codescripts')
            <script src="{{ asset('js/dashboard-filter.js') }}"></script>
        @endpush
    @endif
    <!-- start page title -->
    @component('components.breadcrumb')
        @slot('li_1')
            Contacts
        @endslot
        @slot('title')
            PHYSICAL
        @endslot
    @endcomponent

    <div class="row align-items-center">
        <div class="col-md-6">

        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">

                {{ session('success') }}

                <button class="btn-close" data-bs-dismiss="alert"></button>

            </div>
        @endif
        <div class="col-md-6">
            <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                <div>
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('physical.index') }}" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="List"><i class="bx bx-list-ul"></i></a>
                        </li>

                    </ul>
                </div>
                <div>
                    <!-- <a href="{{ route('physical.create') }}" class="btn btn-light"><i class="bx bx-plus me-1"></i> Add
                            New</a> -->
                    <form action="{{ route('physical.generate') }}" method="POST">

                        @csrf

                        <button class="btn btn-success">

                            Generate Physical

                        </button>

                    </form>
                </div>

                <!-- <div class="dropdown">
                        <a class="btn btn-link text-muted py-1 font-size-16 shadow-none dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-horizontal-rounded"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Edit</a></li>
                            <li><a class="dropdown-item" href="#">Hapus</a></li>
                        </ul>
                    </div> -->
            </div>

        </div>
    </div>
    <!-- end row -->
    <div class="card mb-3">
        <div class="card-body">

            <form method="GET" action="{{ route('physical.index') }}">

                <div class="row">

                    <div class="col-md-3">

                        <label class="form-label">Periode</label>
                        <input type="month" name="periode" class="form-control"
                            value="{{ request('periode', $periodeTerbaru) }}">

                    </div>

                    <div class="col-md-2 d-flex align-items-end">

                        <button class="btn btn-primary me-2">

                            <i class="fas fa-search"></i>

                            Filter

                        </button>

                        <a href="{{ route('physical.index') }}" class="btn btn-secondary">

                            Reset

                        </a>

                    </div>

                </div>

            </form>

        </div>
    </div>

    <div class="table-responsive mb-4" id="tablecontent">
        <table id="example" class="display nowrap table table-striped table-bordered scroll-horizontal font-size-11"
            cellspacing="0" style="border-collapse: collapse;  width: 100%;">
            <thead>
                <tr>
                    <TH SCOPE="COL">PERIODE</TH>
                    <TH SCOPE="COL">CODE UNIT</TH>
                    <TH SCOPE="COL">SERIAL NUMBER</TH>
                    <TH SCOPE="COL">WORK DAYS</TH>
                    <TH SCOPE="COL">UNIT WORK PLAN (MINUTES)</TH>
                    <TH SCOPE="COL">TOTAL BREAKDOWN UNIT (MINUTES)</TH>
                    <TH SCOPE="COL">TOTAL BACKUP UNIT (MINUTES)</TH>
                    <TH SCOPE="COL">TOTAL WORKING UNIT (MINUTES)</TH>
                    <TH SCOPE="COL">PA FORKLIFT (%)</TH>
                    <TH SCOPE="COL">CBU</TH>
                    <TH SCOPE="COL">REGION</TH>
                    <TH SCOPE="COL">SITE NAME</TH>
                    <TH>ACTION</TH>


                </tr>
            </thead>
            <tbody>
                @php $i=1; @endphp
                @foreach ($physical as $key)
                    <tr>
                        <td scope="col">{{ $key->periode }}</td>
                        <td scope="col">{{ $key->kdunit }}</td>
                        <td scope="col">{{ $key->getunit->serialnumber }}</td>
                        <td scope="col">{{ $key->harikerja }}</td>
                        <td scope="col"> {{ number_format($key->getPlanUnitKerjaAttribute()) }}</td>
                        <td scope="col"><a
                                href="{{ route('trouble.listaction', $key->kdunit) }}">{{ $key->getTotalBreakdownAttribute() }}</a>
                        </td>
                        <td scope="col">{{ number_format($key->totalbackup) }}</td>
                        <td scope="col">{{ number_format($key->getTotalWorkingAttribute()) }}</td>
                        <td scope="col">{{ number_format($key->getPaforkliftAttribute(), 2) }}</td>

                        <td scope="col">{{ $key->getcbu->namasitename }}</td>
                        <td scope="col">{{ $key->getregion->namasitename }}</td>
                        <td scope="col">{{ $key->getsitename->namasitename }}</td>


                        <td style="width: 200px; min-width: 80px;">
                            <div style="float:right; width:60px"><a class="btn btn-sm btn-warning"
                                    href="{{ route('physical.edit', $key->id) }}">Edit</a></div>
                            <div style="float:right; width:60px">
                                <form action="{{ route('physical.destroy', $key->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Hapus Data ini?');">Hapus</button>
                                </form>
                            </div>



                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('.btn-action').click(function() {
                var url = $(this).data("url");

                $.ajax({
                    url: url,
                    dataType: 'html',
                    success: function(res) {
                        var data = res;
                        $('.modal-body').html(data);
                        $('#staticBackdrop').modal('show');
                    },
                    error: function(request, status, error) {
                        console.log("ajax call went wrong:" + request.responseText);
                    }
                });
            });
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
        </script>

        <!-- end table -->
    </div>
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
