@extends('layouts.master')

@section('title')
    DELIVERY
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
    @endif
    <!-- start page title -->
    @component('components.breadcrumb')
        @slot('li_1')
            DELIVERY
        @endslot
        @slot('title')
            DELIVERY
        @endslot
    @endcomponent

    <div class="row align-items-center g-2 mb-3">

        <div class="col-auto">
            <ul class="nav nav-pills mb-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('delivery.index') }}" data-bs-toggle="tooltip" title="List">
                        <i class="bx bx-list-ul"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="col-auto">
            <a href="{{ route('delivery.create') }}" class="btn btn-light">
                <i class="bx bx-plus me-1"></i> Add New
            </a>
        </div>

        <div class="col-auto">
            @include('filter_site')
        </div>

    </div>
    <!-- end row -->

    <div class="table-responsive mb-4" id="tablecontent">
        <table id="example" class="table table-sm table-striped table-hover table-bordered nowrap w-100 align-middle">
            <thead>
                <tr>


                    <TH SCOPE="COL">CUSTOMER DATE REQUEST <br>(YYYY/MM/DD)</TH>
                    <TH SCOPE="COL">PO NUMBER</TH>
                    <TH SCOPE="COL">SERIAL NUMBER</TH>
                    <TH SCOPE="COL">FORKLIFT TYPE</TH>
                    <TH SCOPE="COL">CAPACITY (KILOGRAM)</TH>
                    <TH SCOPE="COL">MAST (STAGE)</TH>
                    <TH SCOPE="COL">HEIGHT (METER)</TH>

                    <TH SCOPE="COL">ESTIMATED DELIVERY</TH>
                    <TH SCOPE="COL">ACTUAL DELIVERY</TH>
                    <TH SCOPE="COL">DAYS OF LAPSE</TH>
                    <TH SCOPE="COL">REASON OF LAPSE</TH>

                    <TH SCOPE="COL">STATUS SPP</TH>
                    <TH SCOPE="COL">STATUS CUSTOMER</TH>
                    <TH SCOPE="COL">REMARK PLANT</TH>
                    <th style="width: 80px; min-width: 80px;">ACTION</th>


                </tr>
            </thead>
            <tbody>
                @php $i=1; @endphp
                @foreach ($delivery as $key)
                    <tr>

                        <th scope="col">{{ $key->daterequest }}</th>
                        <th scope="col">{{ $key->ponumber }}</th>
                        <th scope="col">{{ $key->serialnumber }}</th>
                        <th scope="col">{{ $key->getforklifttype->namaforklifttype }}</th>
                        <th scope="col">{{ number_format($key->capacity, 0) }}</th>
                        <th scope="col">{{ round($key->mast, 1) }}</th>
                        <th scope="col">{{ round($key->masheight, 1) }}</th>
                        <th scope="col">{{ $key->dateestimated }}</th>
                        <th scope="col">{{ $key->dateactual }}</th>


                        <th scope="col">{{ $key->daysoflapse }}</th>
                        <th scope="col">{{ $key->reason }}</th>

                        <th scope="col">

                            @if ($key->statusspp == 'CLOSE')
                                <span class="badge badge-pill badge-soft-success font-size-12">{{ $key->statusspp }}</span>
                            @else
                                <span class="badge badge-pill badge-soft-danger font-size-12">{{ $key->statusspp }}</span>
                                @if (Auth::user()->roles_id == '1' || Auth::user()->roles_id == '2')
                                    <a class="btn btn-sm btn-info  btn-action"
                                        data-url="{{ URL('delivery/formstatus?aid=spp&id=' . $key->id) }}"
                                        id="btnAction1"><i class=" fas fa-key"></i></a>
                                @endif
                            @endif
                        </th>
                        <th scope="col">
                            @if ($key->statuscustomer == 'CLOSE')
                                <span
                                    class="badge badge-pill badge-soft-success font-size-12">{{ $key->statuscustomer }}</span>
                            @else
                                <span
                                    class="badge badge-pill badge-soft-danger font-size-12">{{ $key->statuscustomer }}</span>
                                @if (Auth::user()->roles_id == '5' || Auth::user()->roles_id == '4')
                                    <a class="btn btn-sm btn-info  btn-action"
                                        data-url="{{ URL('delivery/formstatus?aid=customer&id=' . $key->id) }}"
                                        id="btnAction1"><i class=" fas fa-key"></i></a>
                                @endif
                            @endif
                        </th>
                        <th scope="col">{{ $key->remarkplan }}</th>

                        <th style="width: 80px; min-width: 80px;">
                            @if (Auth::user()->roles_id == '1' || Auth::user()->roles_id == '2')
                                <div class="d-flex gap-1">
                                    <a class="btn btn-info btn-sm btn-action"
                                        href="{{ route('delivery.edit', $key->id) }}"><i class="fas fa-edit"></i></a>


                                    <form action="{{ route('delivery.destroy', $key->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Hapus Data ini?');"><i
                                                class="fas fa-trash"></i></button>
                                    </form>

                                </div>
                            @endif

                        </th>
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
    <script src="{{ URL::asset('build/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
@endsection
