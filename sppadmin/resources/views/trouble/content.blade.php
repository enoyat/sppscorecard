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
        @slot('li_1')
            Trouble
        @endslot
        @slot('title')
            List Of Trouble
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
    @include('layouts.tabel')
    <div class="table-responsive mb-4" id="tablecontent">
        <table id="example" class="display nowrap table table-striped table-bordered scroll-horizontal font-size-11"
            cellspacing="0" style="border-collapse: collapse;  width: 100%;">
            <thead>
                <tr>

                    <TH SCOPE="COL">STATUS MECHANIC</TH>
                    <TH SCOPE="COL">STATUS CUSTOMER</TH>
                    <TH SCOPE="COL">MECHANIC</TH>
                    <TH SCOPE="COL">CODE UNIT</TH>
                    <TH SCOPE="COL">START DATE</TH>
                    <TH SCOPE="COL">DATE OF COMPLETION</TH>
                    <TH SCOPE="COL">LAPSE TIME (MINUTE)</TH>
                    <TH SCOPE="COL">BACKUP</TH>
                    <TH SCOPE="COL">SHIFT</TH>
                    <TH SCOPE="COL">ACTION PLAN</TH>
                    <TH SCOPE="COL">SPAREPARTS</TH>
                    <TH SCOPE="COL">DOCUMENTS</TH>
                    <TH SCOPE="COL">ACTION</TH>


                </tr>
            </thead>
            <tbody>
                @php $i=1; @endphp
                @foreach ($listactions as $key)
                    <tr>

                        <th scope="col">

                            @if ($key->statusmekanik == 'CLOSE')
                                <span
                                    class="badge badge-pill badge-soft-success font-size-12">{{ $key->statusmekanik }}</span>
                            @else
                                <span
                                    class="badge badge-pill badge-soft-danger font-size-12">{{ $key->statusmekanik }}</span>
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
                                        data-url="{{ URL('trouble/formstatus?aid=customer&id=' . $key->id) }}"
                                        id="btnAction1"><i class=" fas fa-key"></i></a>
                                @endif
                            @endif
                        </th>
                        <th scope="col">{{ $key->getuser->name }}</th>
                        <th scope="col">{{ $key->kdunit }} </th>
                        <th scope="col">{{ $key->tanggalmulai }}</th>
                        <th scope="col">{{ $key->tanggalakhir }}</th>
                        <th scope="col">{{ $key->lapsetime }}</th>
                        <th scope="col">{{ $key->terbackup }}</th>
                        <th scope="col">{{ $key->shift }}</th>
                        <th scope="col">{{ $key->actionplan }} </th>
                        <th scope="col">{{ $key->sparepart }}</th>
                        <th scope="col"><a href="{{ route('trouble.listdokumen', $key->id) }}"
                                class="btn btn-sm btn-warning">List Foto</a></th>
                        <th scope="col">
                            <form action="{{ route('trouble.actiondestroy', $key->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus Data ini?');"
                                    class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- end table -->
    </div>
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
