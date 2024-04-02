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
            Update penalty
        @endslot
    @endcomponent


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form penalty</h4>
                </div>
                <div class="card-body p-4">

                    <form action="{{ route('penalty.update', $penalty->idpenalty) }}" method="POST">
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
                                            <option value="{{ $penalty->idcbu }}" selected>
                                                {{ $penalty->getcbu->namasitename }}</option>
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
                                            <option value="{{ $penalty->idregion }}">{{ $penalty->getregion->namasitename }}
                                            </option>
                                        </select>

                                    </div>
                                    <div class="mb-3">
                                        <label for="example-text-input" class="form-label">Site Name</label>
                                        <select class="form-select" aria-label="Default select example" name="idsitename"
                                            id="idsitename">
                                            <option value="{{ $penalty->idsitename }}">
                                                {{ $penalty->getsitename->namasitename }}</option>
                                        </select>

                                    </div>
                                    <div class="mb-3">
                                        <label for="example-password-input" class="form-label">Periode</label>
                                        <input class="form-control" type="text" value="{{ $penalty->periode }}"
                                            name="periode" id="periode" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-password-input" class="form-label">CODE Unit</label>
                                        <input class="form-control" type="text" value="{{ $penalty->kdunit }}"
                                            name="kdunit" id="kdunit" readonly>
                                    </div>


                                    <div class="mb-3">
                                        <label for="example-tel-input" class="form-label">Price</label>
                                        <input class="form-control" type="tel" value="{{ $penalty->price }}"
                                            name="price" id="price">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-tel-input" class="form-label">Penalty</label>
                                        <input class="form-control" type="tel" value="{{ $penalty->penalty }}"
                                            name="penalty" id="penalty">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-date-input" class="form-label">Show Customer (Wajib)</label>
                                        <select class="form-select" aria-label="Default select example" name="showcustomer"
                                            id="showcustomer">

                                            <option value="{{ $penalty->showcustomer }}" selected>{{ $penalty->showcustomer }}</option>
                                            <option value="Y">Yes</option>
                                            <option value="N">No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-date-input" class="form-label">Flag Baru/Lama</label>
                                        <select class="form-select" aria-label="Default select example" name="flag_baru"
                                            id="flag_baru">

                                            <option value="{{ $penalty->flag_baru }}" selected>{{ $penalty->flag_baru }}</option>
                                            <option value="B">B</option>
                                            <option value="L">L</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-date-input" class="form-label">Date Request</label>
                                        <input class="form-control" type="date" value="{{ $penalty->daterequest }}" name="daterequest"
                                            id="daterequest">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-date-input" class="form-label">Date Estimated</label>
                                        <input class="form-control" type="date" value="{{ $penalty->dateestimated }}" name="dateestimated"
                                            id="dateestimated">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-date-input" class="form-label">Date Actual</label>
                                        <input class="form-control" type="date" value="{{ $penalty->dateactual }}" name="dateactual"
                                            id="dateactual">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-date-input" class="form-label">Reason</label>
                                        <input class="form-control" type="text" value="{{ $penalty->reason }}" name="reason" id="reason">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-date-input" class="form-label">Flag Target</label>
                                        <select class="form-select" aria-label="Default select example" name="flag_target"
                                            id="flag_target">

                                            <option value="{{ $penalty->flag_target }}" selected>{{ $penalty->flag_target }}</option>
                                            <option value="Y">Yes</option>
                                            <option value="N">No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-date-input" class="form-label">Flag Actual</label>
                                        <select class="form-select" aria-label="Default select example" name="flag_actual"
                                            id="flag_actual">

                                            <option value="{{ $penalty->flag_actual }}" selected>{{ $penalty->flag_actual }}</option>
                                            <option value="Y">Yes</option>
                                            <option value="N">No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-date-input" class="form-label">OTIF/LATE</label>
                                        <select class="form-select" aria-label="Default select example" name="flag_otif"
                                            id="flag_otif">

                                            <option value="{{ $penalty->flag_otif }}" selected>{{ $penalty->flag_otif }}</option>
                                            <option value="OTIF">OTIF</option>
                                            <option value="LATE">LATE</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary w-md">Submit</button>

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">

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
        $('#price').keyup(function() {
            var price = $('#price').val();
            var prosentase = $('#prosentase').val();
            var pay = price * prosentase / 100;
            $('#pay').val(pay);
        });
        $('#prosentase').keyup(function() {
            var price = $('#price').val();
            var prosentase = $('#prosentase').val();
            var pay = price * prosentase / 100;
            $('#pay').val(pay);
        });
    </script>





@endsection
