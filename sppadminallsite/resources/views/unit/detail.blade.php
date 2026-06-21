@extends('layouts.master')

@section('title') Unit @endsection

@section('css')

    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('content')



    <div class="row">
        <div class="col-xl-12">
            <div id="myModal" class="modal fade bs-example-modal-center scrollable" tabindex="-1" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">UNIT</h4>
                    <div class="row">
                        <div class="col-3">
                            <a href="{{ route('unit.index') }}" class="btn btn-primary" title="Add">Back</a>

                        </div>

                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#units" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">UNIT</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#maintenance" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">MAINTENANCE</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#trouble" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">TROUBLE</span>
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content p-3 text-muted" id="datadetail">
                        <div class="tab-pane active" id="units" role="tabpanel">
                            @include('unit.dataunit')
                        </div>
                        <div class="tab-pane" id="maintenance" role="tabpanel">
                            @include('unit.datamaintenance')
                        </div>
                        <div class="tab-pane" id="trouble" role="tabpanel">
                            @include('unit.datatrouble')
                        </div>
                    </div>


                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

    <script>
        $(document).on('click', '.imagePreview', function () {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "GET",
                data: {
                    id: id,
                    type: "siloImage"
                },
                url: "{{ route('unit.previewImage') }}",
                success: function (data) {
                    $('.modal-body').html(data);

                    // show modal
                    $('#myModal').modal('show');
                }
            });
            return false;
        });

        $(document).on('click', '.imagePreviewForklift', function () {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "GET",
                data: {
                    id: id,
                    type: "forkliftImage"
                },
                url: "{{ route('unit.previewImage') }}",
                success: function (data) {
                    $('.modal-body').html(data);

                    // show modal
                    $('#myModal').modal('show');
                }
            });
            return false;
        });

        $('#btnsearch').click(function () {
            var keyword = $('#search').val();
            $.ajax({

                url: "{{ route('unit.search') }}",
                method: "GET",
                data: {
                    keyword: keyword
                },
                success: function (data) {
                    $('#datadetail').html(data);
                }
            });
            event.preventDefault();

        });
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $("#search").select2({
            placeholder: 'select unit',
            ajax: {
                url: "{{ route('unit.getunit') }}",
                type: "GET",
                dataType: 'JSON',
                delay: 250,
                data: function (params) {
                    return {
                        _token: CSRF_TOKEN,
                        search: params.term,
                        idsitename: $("#idsitename").val(),
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    </script>
@endsection

@section('script')

    <!-- Required datatable js -->
    <script src="{{ URL::asset('build/libs/datatables/datatables.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ URL::asset('build/js/pages/datatable-pages.init.js') }}"></script>
    <!-- Buttons examples -->
    {{--
    <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script> --}}
    <script src="{{ URL::asset('build/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    {{--
    <script src="{{ URL::asset('build/libs/pdfmake/vfs_fonts.js') }}"></script> --}}
    {{--
    <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
    </script> --}}

    <!-- Datatable init js -->
    <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
@endsection