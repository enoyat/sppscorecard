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

                <form action="{{ route('unit.update', $unit->kdunit) }}" method="POST">
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
                                        <option value="{{ $unit->idcbu }}" selected>{{ $unit->getcbu->namacbu }}
                                        </option>
                                        <option value="">select</option>
                                        @foreach ($cbu as $itemcbu)
                                        <option value="{{ $itemcbu->id }}">{{ $itemcbu->namacbu }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Region</label>

                                    <select class="form-select" aria-label="Default select example" name="idregion"
                                        id="idregion">
                                        <option value="{{ $unit->idregion }}">{{ $unit->getregion->namaregion }}
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
                                    <label for="example-password-input" class="form-label">Kode Unit</label>
                                    <input class="form-control" type="text" value="{{ $unit->kdunit }}" name="kdunit"
                                        id="kdunit">
                                        <small class="text-danger">Kode Unit tidak boleh sama dan tidak boleh ada spasi</small>
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Equipment</label>
                                    <input class="form-control" type="text" value="{{ $unit->equipment }}" name="equipment" id="equipment">                                       
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