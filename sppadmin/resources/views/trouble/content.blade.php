@extends('layouts.master')

@section('title')
trouble
@endsection

@section('css')

<!-- DataTables -->
<link href="{{ URL::asset('build/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<!-- start page title -->
@component('components.breadcrumb')
@slot('li_1') Trouble @endslot
@slot('title') List Of Trouble @endslot
@endcomponent

<div class="row align-items-center">
    <div class="col-md-6">

    </div>

    <div class="col-md-6">
        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
            <div>
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('trouble.index') }}" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="List"><i class="bx bx-list-ul"></i></a>
                    </li>

                </ul>
            </div>
            <div>
                <a href="{{ route('trouble.create') }}" class="btn btn-light"><i class="bx bx-plus me-1"></i> Add
                    New</a>
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
    <table class="table table-striped dt-responsive nowrap w-100"
        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="datatable-buttons">
        <thead>
            <tr>
                <th scope="col" style="width: 50px;">
                    <div class="form-check font-size-16">
                        <input type="checkbox" class="form-check-input" id="checkAll">
                        <label class="form-check-label" for="checkAll"></label>
                    </div>
                </th>
                <TH SCOPE="COL">STATUS MEKANIK</TH>
                <TH SCOPE="COL">ID USER/MEKANIK</TH>
                <TH SCOPE="COL">KODE UNIT</TH>
                <TH SCOPE="COL">TANGGAL MULAI</TH>
                <TH SCOPE="COL">TANGGAL SELESAI</TH>
                <TH SCOPE="COL">LAPSE TIME (MINUTE)</TH>
                <TH SCOPE="COL">SHIFT</TH>
                <TH SCOPE="COL">ACTION PLAN</TH>
                <TH SCOPE="COL">SPAREPARTS</TH>
                <TH SCOPE="COL">DOKUMENTASI</TH>
                <TH SCOPE="COL">ACTION</TH>


            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach ($listactions as $key)
            <tr>
                <th scope="row">
                    <div class="form-check font-size-16">
                        <input type="checkbox" class="form-check-input" id="contacusercheck1">
                        <label class="form-check-label" for="contacusercheck1"></label>
                    </div>
                </th>
                <th scope="col">
                    
                @if ($key->statusmekanik=="CLOSE") 
                    <span class="badge badge-pill badge-soft-success font-size-12">{{ $key->statusmekanik }}</span>
                    @else
                    <span class="badge badge-pill badge-soft-danger font-size-12">{{ $key->statusmekanik }}</span>

                    @endif</th>
                <th scope="col">{{ $key->getuser->name }}</th>
                <th scope="col">{{ $key->kdunit }} </th>
                <th scope="col">{{ $key->tanggalmulai }}</th>
                <th scope="col">{{ $key->tanggalakhir }}</th>
                <th scope="col">{{ $key->lapsetime }}</th>

                <th scope="col">{{ $key->shift }}</th>
                <th scope="col">{{ $key->actionplan }} </th>
                <th scope="col">{{ $key->sparepart }}</th>
                <th scope="col"><a href="{{ route('trouble.listdokumen',$key->id) }}" class="btn btn-sm btn-warning">List Foto</a></th>
                <th scope="col">
                                <form action="{{ route('trouble.actiondestroy',$key->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item"
                                        onclick="return confirm('Hapus Data ini?');">Hapus</button>
                                </form>
                </th>
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