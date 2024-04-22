@extends('layouts.master')

@section('title')
payment
@endsection

@section('css')

<!-- DataTables -->
<link href="{{ URL::asset('build/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
@if(Session::get('roles_id')==1 || Session::get('roles_id')==5)
    @include('header_select')
@endif
<!-- start page title -->
@component('components.breadcrumb')
@slot('li_1') Contacts @endslot
@slot('title') payment @endslot
@endcomponent

<div class="row align-items-center">
    <div class="col-md-6">

    </div>

    <div class="col-md-6">
        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
            <div>
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('payment.index') }}" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="List"><i class="bx bx-list-ul"></i></a>
                    </li>

                </ul>
            </div>
            <div>
                <a href="{{ route('payment.create') }}" class="btn btn-light"><i class="bx bx-plus me-1"></i> Add New</a>
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

<div class="table-responsive mb-4" id="tablecontent">
    @include('payment.content')

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
