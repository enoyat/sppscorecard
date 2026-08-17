@extends('layouts.master')

@section('title')
    UNIT
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
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
            UNIT
        @endslot
        @slot('title')
            UNIT
        @endslot
    @endcomponent
    @include('sweetalert::alert')


    <div class="row align-items-center g-2 mb-3">

        <div class="col-auto">
            <ul class="nav nav-pills mb-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('unit.index') }}" data-bs-toggle="tooltip" title="List">
                        <i class="bx bx-list-ul"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="col-auto">
            @include('filter_site')
        </div>

    </div>
    <div class="table-responsive mb-4" id="tablecontent">
        @include('unit.content')

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

    <script src="{{ URL::asset('build/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/pdfmake/build/pdfmake.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
@endsection
