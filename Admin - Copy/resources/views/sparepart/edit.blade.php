@extends('layouts.master')

@section('title') @lang('translation.Basic_Elements') @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Update sparepart @endslot
@endcomponent


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form sparepart</h4>
            </div>
            <div class="card-body p-4">

                <form action="{{ route('sparepart.update',$sparepart->id) }}" method="POST">
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
                                    <label for="example-password-input" class="form-label">Nama Spare Part</label>
                                    <input class="form-control" type="text" value="{{ $sparepart->namasparepart }}" name="namasparepart" id="namasparepart">
                                </div>
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">Uom</label>
                                    <input class="form-control" type="text" value="{{ $sparepart->uom }}" name="uom" id="uom">
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