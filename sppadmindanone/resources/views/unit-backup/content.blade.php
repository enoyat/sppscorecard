@include('layouts.tabel')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Units</h4>
                <div class="row">
                    <div class="col-3">
                        <select name="search" id="search" required class="form-control"></select>

                    </div>
                    <div class="col-3">
                        <button type="button" class="btn btn-primary" id="btnsearch" title="search"><i
                                class="bx bx-search"></i></button>
                    </div>
                </div>
            </div><!-- end card header -->

            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#units" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">Unit</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#maintenance" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block">Maintenance</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#trouble" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                            <span class="d-none d-sm-block">Trouble</span>
                        </a>
                    </li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted" id="datadetail">

                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->


</div><!-- end row -->


<script>
    $('#btnsearch').click(function() {
        var keyword = $('#search').val();
        $.ajax({

            url: "{{ route('unit.search') }}",
            method: "GET",
            data: {
                keyword: keyword
            },
            success: function(data) {
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
            data: function(params) {
                return {
                    _token: CSRF_TOKEN,
                    search: params.term,
                    idsitename: $("#idsitename").val(),
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });
</script>
