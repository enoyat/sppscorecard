@extends('layouts.master')

@section('title') @lang('translation.Dashboard') @endsection

@section('css')

<link href="{{ URL::asset('build/libs/jquery-vectormap/jquery-vectormap.min.css') }}" rel="stylesheet"
    type="text/css" />
<!-- glightbox css -->
<link rel="stylesheet" href="{{ URL::asset('build/libs/glightbox/css/glightbox.min.css') }}">
<!-- DataTables -->
<link href="{{ URL::asset('build/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
{{-- <link href="{{ URL::asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
    rel="stylesheet" type="text/css" /> --}}

@endsection


@section('content')


@component('components.breadcrumb')
@slot('li_1') Extended @endslot
@slot('title') Dashboard @endslot
@endcomponent
<div class="row">
    <div class="col-12">

        <div class="card " >
            <div class="card-header">
                <h4 class="card-title">KPI DASHBOARD</h4>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <form action="" method="GET" class="form-inline form-row">

                            <div class="col">
                                <div class="input-group mx-1">

                                    <input name="periode" type="search" value="{{ request()->get('periode') }}"
                                        class="form-control" placeholder="Periode (yyyy-mm)">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <br>
                <div class="row">

                    <div class="col-md-8" style="background-color: #d8f7ad;" >

                        @if($kpi)
                        <table class="table table-striped dt-responsive nowrap w-100"
                            style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;"
                            id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 50px;">
                                        <div class="form-check font-size-16">
                                            <input type="checkbox" class="form-check-input" id="checkAll">
                                            <label class="form-check-label" for="checkAll"></label>
                                        </div>
                                    </th>
                                    <th scope="col">Unit Type</th>
                                    <th scope="col">Units</th>
                                    <th scope="col">Total Hour Availability (minute)</th>
                                    <th scope="col">Target Hour Availability (minute)</th>
                                    <th scope="col">Achievement (%)</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($kpi as $item)
                                <tr>
                                    <td scope="row">
                                        <div class="form-check font-size-16">
                                            <input type="checkbox" class="form-check-input" id="contacusercheck1">
                                            <label class="form-check-label" for="contacusercheck1"></label>
                                        </div>
                                    </td>
                                    <td>{{ $item->namaforklifttype }}</td>
                                    <td style="text-align: center;">{{ $item->jmlunit }}</td>
                                    <td style="text-align: center;">{{ number_format($item->sumplanunitkerja) }}</td>
                                    <td style="text-align: center;">{{ number_format($item->sumtotaljamkerja) }}</td>
                                    <td style="text-align: center; color:blue">{{ number_format($item->avgpaforklift,2) }}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        Selamat Datang di Sistem Informasi Scorecard PT. Satria Piranti Perkasa
                        @endif
                    </div>
                </div>
            </div>




        </div>
    </div>
    <!-- end cardaa -->
</div> <!-- end col -->
</div> <!-- end row -->




@endsection

@section('script')
<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- Plugins js-->
<script src="{{ URL::asset('build/libs/jquery-vectormap/jquery-vectormap.min.js') }}"></script>
{{-- <script src="buildlibs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script> --}}
<!-- dashboard init -->
<script src="{{ URL::asset('build/js/pages/dashboard.init.js') }}"></script>
{{-- <script src="{{ URL::asset('buildjs/app.min.js') }}"></script> --}}
<!-- glightbox js -->
<script src="{{ URL::asset('build/libs/glightbox/js/glightbox.min.js') }}"></script>

<!-- lightbox init -->
<script src="{{ URL::asset('build/js/pages/lightbox.init.js') }}"></script>
<!-- Required datatable js -->
<script src="{{ URL::asset('build/libs/datatables/datatables.min.js') }}"></script>
{{-- <script src="{{ URL::asset('build/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script> --}}

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