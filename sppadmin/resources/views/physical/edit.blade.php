@extends('layouts.master')

@section('title') PT. Satria Piranti Perkasa @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Update Physical @endslot
@endcomponent


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form physical</h4>
            </div>
            <div class="card-body p-4">

                <form action="{{ route('physical.update',$physical->id) }}" method="POST">
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
                                        <option value="{{ $physical->idcbu }}" selected>{{ $physical->getcbu->namasitename }}</option>
                                        <option value="" >select</option>
                                        @foreach ($cbu as $itemcbu)
                                        <option value="{{ $itemcbu->id }}">{{ $itemcbu->namasitename }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Region</label>

                                    <select class="form-select" aria-label="Default select example" name="idregion"
                                        id="idregion">
                                        <option value="{{ $physical->idregion }}">{{ $physical->getregion->namasitename }}</option>
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Site Name</label>
                                    <select class="form-select" aria-label="Default select example" name="idsitename"
                                        id="idsitename">
                                        <option value="{{ $physical->idsitename }}">{{ $physical->getsitename->namasitename }}</option>
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Periode</label>
                                    <input class="form-control" type="text" value="{{ $physical->periode }}" name="periode"
                                        id="periode" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">CODE Unit</label>
                                    <input class="form-control" type="text" value="{{ $physical->kdunit }}" name="kdunit"
                                        id="kdunit" readonly>
                                </div>


                                <div class="mb-3">
                                    <label for="example-tel-input" class="form-label">WORK DAYS</label>
                                    <input class="form-control" type="tel" value="{{ $physical->harikerja }}" name="harikerja" id="harikerja">
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Plan WORK DAYS (Minutes)</label>
                                    <input class="form-control" type="text" value="{{ $physical->planunitkerja }}" name="planunitkerja" id="planunitkerja">
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Total Break Down (Minutes)</label>
                                    <input class="form-control" type="text" value="{{ $physical->totalbreakdown }}" name="totalbreakdown" id="totalbreakdown" readonly>
                                </div>



                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mt-3 mt-lg-0">
                            <div class="mb-3">
                                    <label for="example-month-input" class="form-label">TOTAL WORKING UNIT (MINUTES)</label>
                                    <input class="form-control" type="text" value="{{ $physical->totaljamkerja }}" name="totaljamkerja" id="totaljamkerja" readonly>
                                </div>
                            <div class="mb-3">
                                    <label for="example-week-input" class="form-label">PA Forklift</label>
                                    <input class="form-control" type="text" value="{{ $physical->paforklift }}" name="paforklift"
                                        id="paforklift" readonly>
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
