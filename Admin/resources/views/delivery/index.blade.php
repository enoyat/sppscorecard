@extends('layouts.master')

@section('title') @lang('translation.User_List') @endsection

@section('css')

<!-- DataTables -->
<link href="{{ URL::asset('build/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
@include('header_select')
<!-- start page title -->
@component('components.breadcrumb')
@slot('li_1') Contacts @endslot
@slot('title') Delivery @endslot
@endcomponent

<div class="row align-items-center">
    <div class="col-md-6">

    </div>

    <div class="col-md-6">
        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
            <div>
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('delivery.index') }}" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="List"><i class="bx bx-list-ul"></i></a>
                    </li>

                </ul>
            </div>
            <div>
                <a href="{{ route('delivery.create') }}" class="btn btn-light"><i class="bx bx-plus me-1"></i> Add New</a>
            </div>

            <div class="dropdown">
                <a class="btn btn-link text-muted py-1 font-size-16 shadow-none dropdown-toggle" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-dots-horizontal-rounded"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Edit</a></li>
                    <li><a class="dropdown-item" href="#">Hapus</a></li>
                </ul>
            </div>
        </div>

    </div>
</div>
<!-- end row -->

<div class="table-responsive mb-4">
    <table class="table align-middle datatable dt-responsive table-check nowrap table-striped "
        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
        <thead>
            <tr>
                <th scope="col" style="width: 50px;">
                    <div class="form-check font-size-16">
                        <input type="checkbox" class="form-check-input" id="checkAll">
                        <label class="form-check-label" for="checkAll"></label>
                    </div>
                </th>
                <th scope="col">Serial Number</th>
                <th scope="col">Forklif Type</th>
                <th scope="col">Capacity</th>
                <th scope="col">Mas Height (m)</th>
                <th scope="col">Estimated Delivery</th>
                <th scope="col">Reason of Lapse</th>
                <th scope="col">Mitigation Plant</th>
                <th scope="col">Actual Delivery</th>
                <th scope="col">Confirmation by Plant</th>
                <th scope="col">Status SPP</th>
                <th scope="col">Status Customer</th>
                <th style="width: 80px; min-width: 80px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach ($delivery as $key)
            <tr>
                <th scope="row">
                    <div class="form-check font-size-16">
                        <input type="checkbox" class="form-check-input" id="contacusercheck1">
                        <label class="form-check-label" for="contacusercheck1"></label>
                    </div>
                </th>
                <th scope="col">{{ $key->serialnumber }}</th>
                <th scope="col">{{ $key->idforklifttype }}</th> 
                <th scope="col">{{ $key->capacity }}</th>
                <th scope="col">{{ $key->masheight }}</th>
                <th scope="col">{{ $key->dateestimated }}</th>
                <th scope="col">{{ $key->reason }}</th>
                <th scope="col">{{ $key->mitigationplan }}</th>
                <th scope="col">{{ $key->dateactual }}</th>
                <th scope="col">{{ $key->confirmationplan }}</th>
                <th scope="col">{{ $key->statusspp }}</th>
                <th scope="col">{{ $key->statuscustomer }}</th>
                <th style="width: 80px; min-width: 80px;">Action</th>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- end table -->
</div>
<!-- end table responsive -->
@endsection

@section('script')

<!-- Required datatable js -->
<script src="{{ URL::asset('build/libs/datatables/datatables.min.js') }}"></script>

<!-- init js -->
<script src="{{ URL::asset('build/js/pages/datatable-pages.init.js') }}"></script>

@endsection