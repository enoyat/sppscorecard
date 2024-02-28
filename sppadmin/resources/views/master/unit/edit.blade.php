@extends('layouts.master')

@section('title') PT. Satria Piranti Perkasa @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Edit Unit @endslot
@endcomponent


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Unit </h4>
            </div>
            <div class="card-body p-4">

                <form action="{{ route('masterunit.update', $unit->kdunit) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
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
                                        <option value="{{ $unit->idcbu }}" selected>{{ $unit->getcbu->namasitename }}
                                        </option>
                                        <option value="">select</option>
                                        @foreach ($cbu as $itemcbu)
                                        <option value="{{ $itemcbu->id }}">{{ $itemcbu->namasitename }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Region</label>

                                    <select class="form-select" aria-label="Default select example" name="idregion"
                                        id="idregion">
                                        <option value="{{ $unit->idregion }}">{{ $unit->getregion->namasitename }}
                                        </option>
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Site Name</label>
                                    <select class="form-select" aria-label="Default select example" name="idsitename"
                                        id="idsitename">
                                        <option value="{{ $unit->idsitename }}">
                                            {{ $unit->getsitename->namasitename }}</option>
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">CODE Unit</label>
                                    <input class="form-control" type="text" value="{{ $unit->kdunit }}" name="kdunit"
                                        id="kdunit">
                                        <small class="text-danger">CODE Unit tidak boleh sama dan tidak boleh ada spasi</small>
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Equipment</label>
                                    <input class="form-control" type="text" value="{{ $unit->equipment }}" name="equipment" id="equipment">
                                </div>
                                <div class="mb-3">
                                    <label for="example-url-input" class="form-label">Forklif Type</label>
                                    <select class="form-select" aria-label="Default select example" name="idforklifttype"
                                        id="idforklifttype">
                                        <option value="{{ $unit->idforklifttype }}" selected>
                                            {{ $unit->getforklifttype->namaforklifttype }}</option>
                                        @foreach ($forklifttype as $itemforklifttype)
                                        <option value="{{ $itemforklifttype->id }}">{{ $itemforklifttype->namaforklifttype }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Merk</label>
                                    <input class="form-control" type="text" value="{{ $unit->merk }}" name="merk" id="merk">
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Type</label>
                                    <input class="form-control" type="text" value="{{ $unit->type }}" name="type" id="type">
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Model</label>
                                    <input class="form-control" type="text" value="{{ $unit->model }}" name="model" id="model">
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Capcity</label>
                                    <input class="form-control" type="text" value="{{ $unit->capcity }}" name="capcity" id="capcity">
                                </div>


                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Serial Number</label>
                                    <input class="form-control" type="text" value="{{ $unit->serialnumber }}" name="serialnumber"
                                        id="serialnumber">

                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Specification</label>
                                    <input class="form-control" type="text" value="{{ $unit->specification }}" name="specification" id="specification">
                                </div>
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">Qty</label>
                                    <input class="form-control" type="number" value="{{ $unit->qty }}" name="qty"
                                        id="qty" required>
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Mast (Stage)</label>
                                    <input class="form-control" type="text" value="{{ $unit->mast }}" name="mast"
                                        id="mast">
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Mast Height (meter)</label>
                                    <input class="form-control" type="text" value="{{ $unit->masheight }}" name="masheight"
                                        id="masheight">
                                </div>

                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Foto Unit</label>
                                    <input class="form-control" type="file" value="" name="filefoto"
                                        id="filefoto">
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Price</label>
                                    <input class="form-control" type="text" value="{{ $unit->price }}" name="price"
                                        id="price">
                                </div>
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">Show Customer</label>
                                    <select class="form-select" aria-label="Default select example" name="showcustomer"
                                        id="showcustomer">

                                        <option value="{{ $unit->showcustomer }}" selected>{{ $unit->showcustomer }}</option>
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">Flag Baru/Lama</label>
                                    <select class="form-select" aria-label="Default select example" name="flag_baru"
                                        id="flag_baru">

                                        <option value="{{ $unit->flag_baru }}" selected>{{ $unit->flag_baru }}</option>
                                        <option value="B">B</option>
                                        <option value="L">L</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">Date Request</label>
                                    <input class="form-control" type="date" value="{{ $unit->daterequest }}" name="daterequest"
                                        id="daterequest">
                                </div>
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">Date Estimated</label>
                                    <input class="form-control" type="date" value="{{ $unit->dateestimated }}" name="dateestimated"
                                        id="dateestimated">
                                </div>
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">Date Actual</label>
                                    <input class="form-control" type="date" value="{{ $unit->dateactual }}" name="dateactual"
                                        id="dateactual">
                                </div>
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">Reason</label>
                                    <input class="form-control" type="text" value="{{ $unit->reason }}" name="reason" id="reason">
                                </div>
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">Flag Target</label>
                                    <select class="form-select" aria-label="Default select example" name="showcustomer"
                                        id="showcustomer">

                                        <option value="{{ $unit->flag_target }}" selected>{{ $unit->flag_target }}</option>
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">Flag Actual</label>
                                    <select class="form-select" aria-label="Default select example" name="flag_actual"
                                        id="flag_actual">

                                        <option value="{{ $unit->flag_actual }}" selected>{{ $unit->flag_actual }}</option>
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">OTIF/LATE</label>
                                    <select class="form-select" aria-label="Default select example" name="flag_otif"
                                        id="flag_otif">

                                        <option value="{{ $unit->flag_otif }}" selected>{{ $unit->flag_otif }}</option>
                                        <option value="OTIF">OTIF</option>
                                        <option value="LATE">LATE</option>
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
