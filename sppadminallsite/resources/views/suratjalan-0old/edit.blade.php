@extends('layouts.master')

@section('title') PT. Satria Piranti Perkasa @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Edit DELIVERY NOTE @endslot
@endcomponent


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form DELIVERY NOTE</h4>
            </div>
            <div class="card-body p-4">

                <form action="{{ route('suratjalan.update',$suratjalan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
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


                        <div class="col-lg-6">
                            <div>
                            <div class="mb-3">
                                    <label for="example-week-input" class="form-label">Tanggal Terima</label>
                                    <input class="form-control" type="date" value="{{ $suratjalan->tanggalterima }}" name="tanggalterima"
                                        id="tanggalterima">
                                </div>
                                <div class="mb-3">
                                    <label for="example-week-input" class="form-label">Penerima</label>
                                    <input class="form-control" type="text" value="{{ $suratjalan->namapenerima }}" name="namapenerima"
                                        id="namapenerima">
                                </div>
                                <div class="mb-3">
                                    <label for="example-week-input" class="form-label">Tanggal Kembali</label>
                                    <input class="form-control" type="date" value="{{ $suratjalan->tanggalkembali }}" name="tanggalkembali"
                                        id="tanggalkembali">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status SPP</label>
                                    <select class="form-select" name="statuspengirim" id="statuspengirim">
                                    <option value="{{ $suratjalan->statuspengirim }}">{{ $suratjalan->statuspengirim }}</option>
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
