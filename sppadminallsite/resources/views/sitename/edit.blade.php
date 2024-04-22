@extends('layouts.master')

@section('title') PT. Satria Piranti Perkasa @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Update sitename @endslot
@endcomponent


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form sitename</h4>
            </div>
            <div class="card-body p-4">

                <form action="{{ route('sitename.update',$sitename->id) }}" method="POST">
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

                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="example-text-input" class="form-label">Sitename Code</label>
                                <input class="form-control" type="text" name="id" id="id" value="{{ $sitename->id }}"
                                    placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="example-text-input" class="form-label">Sitename</label>
                                <input class="form-control" type="text" name="namasitename"
                                    value="{{ $sitename->namasitename }}" id="namasitename" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="example-text-input" class="form-label">REGION</label>
                                <select class="form-select" aria-label="Default select example" name="idregion"
                                    id="idregion">
                                    @if ($sitename->parent->namasitename!=null)
                                    <option value="{{ $sitename->parentid }}" selected>{{ $sitename->parent->namasitename }}
                                    </option>
                                @endif
                                    <option value="">== select ==</option>
                                    @foreach ($region as $itemregion)
                                        <option value="{{ $itemregion->id }}">{{ $itemregion->namasitename }}</option>
                                    @endforeach
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
