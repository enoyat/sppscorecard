@extends('layouts.master')

@section('title') PT. Satria Piranti Perkasa @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Create mutation @endslot
@endcomponent
@include('sweetalert::alert')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form mutation</h4>
            </div>
            <div class="card-body p-4">

                <form action="{{ route('mutation.store') }}" method="POST">
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
                                    <label for="example-text-input" class="form-label">CBU ASAL</label>
                                    <select class="form-select" aria-label="Default select example" name="idcbuasal"
                                        id="idcbuasal">
                                        <option value="" selected>select</option>
                                        @foreach ($cbu as $itemcbu)
                                        <option value="{{ $itemcbu->id }}">{{ $itemcbu->namasitename }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Region ASAL</label>
                                    <select class="form-select" aria-label="Default select example" name="idregionasal"
                                        id="idregionasal">

                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Site Name ASAL</label>
                                    <select class="form-select" aria-label="Default select example" name="idsitenameasal"
                                        id="idsitenameasal">

                                    </select>

                                </div>


                            </div>



                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Pilih Unit</label>

                                    <select name="kdunitasal" id="kdunitasal"  class="form-control"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">KODE UNIT BARU</label><br>
                                    <small>Isi dengan kode unit yang baru (bila replace kode). isikan dengan kodelama jika hanya mutasi site </small>
                                    <input class="form-control" type="text" name="kdunit" id="kdunit">

                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Date Mutation</label>
                                    <input class="form-control" type="date" name="dateout" id="dateout">
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Type Mutation</label>
                                    <select class="form-select" aria-label="Default select example" name="typemutation"
                                        id="typemutation">
                                        <option value="mutation">Mutation</option>
                                        <option value="replace">Replace</option>
                                    </select>
                                </div>


<div class="mb-3">
                                    <label for="example-text-input" class="form-label">CBU</label>
                                    <select class="form-select" aria-label="Default select example" name="idcbu"
                                        id="idcbu">
                                        <option value="" selected>select</option>
                                        @foreach ($cbu as $itemcbu)
                                        <option value="{{ $itemcbu->id }}">{{ $itemcbu->namasitename }}</option>
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
                                    <button type="submit" class="btn btn-primary w-md">Submit</button>

                                </div>



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
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
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
                html += "<option value='" + datax[i].id + "'>" + datax[i].namasitename +
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

jQuery('#idcbuasal').change(function() {
    jQuery('#idregionasal').html('');
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
                html += "<option value='" + datax[i].id + "'>" + datax[i].namasitename +
                    "</option>";
            }
            $('#idregionasal').html(html);
        }
    });
});
jQuery('#idregionasal').change(function() {
    jQuery('#idsitenameasal').html('');
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
            $('#idsitenameasal').html(html);
        }
    });
});

$("#kdunitasal").select2({
    placeholder: 'Pilih Unit',
    ajax: {
        url: "{{ route('unit.getunit') }}",
        type: "GET",
        dataType: 'JSON',
        delay: 250,
        data: function(params) {
            return {
                _token: CSRF_TOKEN,
                search: params.term,
                idsitename: $('#idsitenameasal').val()
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
$("#kdunitasal").change(function() {
    var id = $(this).val();
    $('#kdunit').val(id);

});
</script>





@endsection
