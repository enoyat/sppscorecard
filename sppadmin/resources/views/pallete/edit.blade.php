@extends('layouts.master')

@section('title') PT. Satria Piranti Perkasa @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Update pallete @endslot
@endcomponent


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form pallete</h4>
            </div>
            <div class="card-body p-4">

                <form action="{{ route('pallete.update',$pallete->id) }}" method="POST">
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
                                        <option value="{{ $pallete->idcbu }}" selected>{{ $pallete->getcbu->namacbu }}</option>
                                        <option value="" >select</option>
                                        @foreach ($cbu as $itemcbu)
                                        <option value="{{ $itemcbu->id }}">{{ $itemcbu->namacbu }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Region</label>
                                    
                                    <select class="form-select" aria-label="Default select example" name="idregion"
                                        id="idregion">
                                        <option value="{{ $pallete->idregion }}">{{ $pallete->getregion->namaregion }}</option>
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Site Name</label>
                                    <select class="form-select" aria-label="Default select example" name="idsitename"
                                        id="idsitename">
                                        <option value="{{ $pallete->idsitename }}">{{ $pallete->getsitename->namasitename }}</option>
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jenis Transaksi</label>
                                    <select class="form-select" name="jenisrequest" id="jenisrequest">
                                    <option value="{{ $pallete->jenisrequest }}" selected>{{ $pallete->jenisrequest }}</option>
                                        <option value="">Select</option>
                                        <option value="Withdrawal">Withdrawal</option>
                                        <option value="Delivery">Delivery</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Qty</label>
                                    <input class="form-control" type="number" value="{{ $pallete->qty }}" name="qty" 
                                        id="qty">
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Date Request</label>
                                    <input class="form-control" type="date" value="{{ $pallete->daterequest }}" name="daterequest"
                                        id="daterequest">
                                </div>

                                <div class="mb-3">
                                    <label for="example-tel-input" class="form-label">Target Date</label>
                                    <input class="form-control" type="date" value="{{ $pallete->targetdate }}" name="targetdate" id="targetdate">
                                </div>




                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mt-3 mt-lg-0">
                            <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Actual Date</label>
                                    <input class="form-control" type="date" value="{{ $pallete->actualdate }}" name="actualdate" id="actualdate">
                                </div>

                                <div class="mb-3">
                                    <label for="example-color-input" class="form-label">Remark</label>
                                    <input class="form-control" type="text" value="{{ $pallete->remark }}" name="remark"
                                        id="remark">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status SPP</label>
                                    <select class="form-select" name="statusspp" id="statusspp">
                                    <option value="{{ $pallete->statusspp }}" selected>{{ $pallete->statusspp }}</option>
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