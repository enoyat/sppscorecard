@extends('layouts.master')

@section('title') @lang('translation.Basic_Elements') @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Create trouble @endslot
@endcomponent


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form trouble</h4>
            </div>
            <div class="card-body p-4">

                <form action="{{ route('trouble.store') }}" method="POST">
                    <div class="row">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Ada kesalahan data, silahkan dicek kembali<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @csrf
                        <div class="col-lg-6">
                            <div>
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">CBU</label>
                                    <select class="form-select" aria-label="Default select example" name="idcbu"
                                        id="idcbu">
                                        <option value="" selected>select</option>
                                        @foreach ($cbu as $itemcbu)
                                        <option value="{{ $itemcbu->id }}">{{ $itemcbu->namacbu }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Region</label>
                                    <select class="form-select" aria-label="Default select example" name="idregion"
                                        id="idregion">

                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Site Name</label>
                                    <select class="form-select" aria-label="Default select example" name="idsitename"
                                        id="idsitename">

                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Tanggal</label>
                                    <input class="form-control" type="date" value="" name="tanggal"
                                        id="tanggal">
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Kode Unit</label>
                                    <input class="form-control" type="text" value="" name="kdunit"
                                        id="kdunit">
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Issue</label>
                                    <input class="form-control" type="text" value="" name="issue"
                                        id="issue">
                                </div>

                                <div class="mb-3">
                                    <label for="example-tel-input" class="form-label">Documentation</label>
                                    <input class="form-control" type="text" value="" name="documentation" id="documentation">
                                </div>




                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mt-3 mt-lg-0">
                            <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Target Completion date</label>
                                    <input class="form-control" type="date" value="" name="targetcompletedate" id="targetcompletedate">
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">ACTION PLAN FROM SPP</label>
                                    <input class="form-control" type="text" value="" name="actionplanspp" id="actionplanspp">
                                </div>
                            <div class="mb-3">
                                    <label for="example-month-input" class="form-label">ACTUAL COMPLETION DATE</label>
                                    <input class="form-control" type="date" value="" name="actualcompletedate" id="actualcompletedate">
                                </div>
                            <div class="mb-3">
                                    <label for="example-week-input" class="form-label">LAPSE TIME (days)</label>
                                    <input class="form-control" type="text" value="" name="lapsetime"
                                        id="lapsetime">
                                </div>

                                <div class="mb-3">
                                    <label for="example-color-input" class="form-label">Confirmation by Plant</label>
                                    <input class="form-control" type="text" value="" name="confirmationplan"
                                        id="confirmationplan">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status SPP</label>
                                    <select class="form-select" name="statusspp" id="statusspp">
                                        <option value="">Select</option>
                                        <option value="OPEN">OPEN</option>
                                        <option value="CLOSE">CLOSE</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status Customer</label>
                                    <select class="form-select" name="statuscustomer" id="statuscustomer">
                                        <option value="">Select</option>
                                        <option value="OPEN">OPEN</option>
                                        <option value="CLOSE">CLOSE</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-md">Submit</button>

                                </div>

                            </div>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->
<script>
    jQuery('#idcbu').change(function() {
    jQuery('#idregion').html('');
    var id = $(this).val();
    var string = "{{ asset('/lokasi/getregion/') }}/" + id;
    $.ajax({
        type: 'GET',
        url: string,
        data: {
            id: id
        },
        dataType: 'json',
        success: function(data) {
            datax = JSON.stringify(data);
            datax = JSON.parse(datax);
            var i;
            var html = '';
            var html = '<option>Select</option>';
            for (i = 0; i < datax.length; i++) {
                html += "<option value='" + datax[i].id + "'>" + datax[i].namaregion +
                    "</option>";
            }
            $('#idregion').html(html);
        }
    });
    });
    jQuery('#idregion').change(function() {
    jQuery('#idsitename').html('');
    var id = $(this).val();
    var string = "{{ asset('/lokasi/getsitename/') }}/" + id;
    $.ajax({
        type: 'GET',
        url: string,
        data: {
            id: id
        },
        dataType: 'json',
        success: function(data) {
            datax = JSON.stringify(data);
            datax = JSON.parse(datax);
            var i;
            var html = '';
            var html = '<option>Select</option>';
            for (i = 0; i < datax.length; i++) {
                html += "<option value='" + datax[i].id + "'>" + datax[i].namasitename +
                    "</option>";
            }
            $('#idsitename').html(html);
        }
    });
    });
</script>





@endsection