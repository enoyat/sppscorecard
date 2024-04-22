@extends('layouts.master')

@section('title')
    PT. Satria Piranti Perkasa
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1')
            Forms
        @endslot
        @slot('title')
            UPDATE FORKLIFTTYPE
        @endslot
    @endcomponent


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">FORM FORKLIFT TYPE</h4>
                </div>
                <div class="card-body p-4">

                    <form action="{{ route('forklifttype.update', $forklifttype->id) }}" method="POST">
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
                                    <label for="example-password-input" class="form-label">Name of Spare Part</label>
                                    <input class="form-control" type="text" value="{{ $forklifttype->namaforklifttype }}"
                                        name="namaforklifttype" id="namaforklifttype">
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Dashboard </label>
                                   <select class="form-control" name="f_dashboard" id="f_dashboard">
                                        <option value="Y" @if ($forklifttype->f_dashboard == "Y") selected @endif>Yes</option>
                                        <option value="N" @if ($forklifttype->f_dashboard == "N") selected @endif>No</option>
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
        jQuery('#idforklifttype').change(function() {
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
