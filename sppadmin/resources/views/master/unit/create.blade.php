@extends('layouts.master')

@section('title') PT. Satria Piranti Perkasa @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Create Unit @endslot
@endcomponent


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Unit </h4>
            </div>
            <div class="card-body p-4">

                <form action="{{ route('masterunit.store') }}" method="POST">
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
                                    <label for="example-password-input" class="form-label">CODE Unit</label>
                                    <input class="form-control" type="text" value="" name="kdunit"
                                        id="kdunit">
                                        <small class="text-danger">CODE Unit tidak boleh sama dan tidak boleh ada spasi</small>
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Equipment</label>
                                    <input class="form-control" type="text" value="" name="equipment" id="equipment">
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Merk</label>
                                    <input class="form-control" type="text" value="" name="merk" id="merk">
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Type</label>
                                    <input class="form-control" type="text" value="" name="type" id="type">
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Model</label>
                                    <input class="form-control" type="text" value="" name="model" id="model">
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Capcity</label>
                                    <input class="form-control" type="text" value="" name="capcity" id="capcity">
                                </div>


                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Serial Number</label>
                                    <input class="form-control" type="text" value="" name="serialnumber"
                                        id="serialnumber">

                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Specification</label>
                                    <input class="form-control" type="text" value="" name="specification" id="specification">
                                </div>
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">Qty</label>
                                    <input class="form-control" type="number" value="" name="qty"
                                        id="qty" required>
                                </div>
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">HM</label>
                                    <input class="form-control" type="number" value="" name="hm"
                                        id="hm" required>
                                </div>
                                <div class="mb-3">
                                    <label for="example-url-input" class="form-label">Forklif Type</label>
                                    <select class="form-select" aria-label="Default select example" name="idforklifttype"
                                        id="idforklifttype">
                                        <option value="" selected>select</option>
                                        @foreach ($forklifttype as $itemforklifttype)
                                        <option value="{{ $itemforklifttype->id }}">{{ $itemforklifttype->namaforklifttype }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Mast (Stage)</label>
                                    <input class="form-control" type="text" value="" name="mast"
                                        id="mast">
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Mast Height (meter)</label>
                                    <input class="form-control" type="text" value="" name="masheight"
                                        id="masheight">
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
</script>





@endsection
