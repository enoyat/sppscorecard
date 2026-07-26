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
@slot('li_1') TROUBLE @endslot
@slot('title') TROUBLE DOKUMENTS @endslot
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
<div class="card shadow-sm mb-3">

    <div class="card-header bg-primary text-white">

        <i class="fas fa-camera"></i>

        Upload Dokumentasi Trouble

    </div>

    <div class="card-body">

        <form action="{{ route('trouble.dokumenstore') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <input type="hidden" name="trouble_id" value="{{ $id }}">

            <div class="mb-3">

                <label>Jenis Dokumen</label>

                <select name="description" class="form-select">

                    <option>Kegiatan Pengerjaan</option>
                    <option>Checklist</option>
                    <option>Service Report</option>
                    <option>Before Service</option>
                    <option>After Service</option>

                </select>

            </div>

            <div class="mb-3">

                <label>Upload Foto (bisa upload beberapa foto sekaligus)</label>

                <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*">

            </div>

            <button class="btn btn-success">

                Upload

            </button>

        </form>

    </div>

</div>
<div class="text-center mb-3">

    <img id="preview" src="" class="img-thumbnail" style="display:none;max-height:250px;">

</div>
<div class="table-responsive mb-4" id="tablecontent">
    <table class="table table-sm table-hover align-middle">

        <thead class="table-light">

            <tr>

                <th width="60">No</th>

                <th width="150">Kategori</th>

                <th>Preview</th>

                <th width="120">Action</th>

            </tr>

        </thead>

        <tbody>

            @foreach($dokumentrouble as $doc)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>

                    <span class="badge bg-info">

                        {{ $doc->keterangan }}

                    </span>

                </td>

                <td>

                    <a href="{{ asset('assets/inventory/'.$doc->filename) }}" target="_blank">

                        <img src="{{ asset('assets/inventory/'.$doc->filename) }}" class="rounded shadow-sm"
                            style="width:90px;height:70px;object-fit:cover;">

                    </a>

                </td>
                <td>

                    <div class="btn-group btn-group-sm">

                        <a href="{{ asset('assets/inventory/'.$doc->filename) }}" target="_blank"
                            class="btn btn-primary">

                            <i class="fas fa-eye"></i>

                        </a>

                        <form action="{{ route('maintenance.dokumendestroy',$doc->id) }}" method="POST"
                            class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger" onclick="return confirm('Hapus foto?')">

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
<!-- end table responsive -->
<script>
$('#image').change(function() {

    let reader = new FileReader();

    reader.onload = function(e) {

        $('#preview')
            .attr('src', e.target.result)
            .show();

    }

    reader.readAsDataURL(this.files[0]);

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