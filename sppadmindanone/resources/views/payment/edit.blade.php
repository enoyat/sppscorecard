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
            Update payment
        @endslot
    @endcomponent


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form payment</h4>
                </div>
                <div class="card-body p-4">

                    <form action="{{ route('payment.update', $payment->idpayment) }}" method="POST">
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
                                            <option value="{{ $payment->idcbu }}" selected>
                                                {{ $payment->getcbu->namasitename }}</option>
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
                                            <option value="{{ $payment->idregion }}">{{ $payment->getregion->namasitename }}
                                            </option>
                                        </select>

                                    </div>
                                    <div class="mb-3">
                                        <label for="example-text-input" class="form-label">Site Name</label>
                                        <select class="form-select" aria-label="Default select example" name="idsitename"
                                            id="idsitename">
                                            <option value="{{ $payment->idsitename }}">
                                                {{ $payment->getsitename->namasitename }}</option>
                                        </select>

                                    </div>
                                    <div class="mb-3">
                                        <label for="example-password-input" class="form-label">Periode</label>
                                        <input class="form-control" type="text" value="{{ $payment->periode }}"
                                            name="periode" id="periode" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-password-input" class="form-label">CODE Unit</label>
                                        <input class="form-control" type="text" value="{{ $payment->kdunit }}"
                                            name="kdunit" id="kdunit" readonly>
                                    </div>


                                    <div class="mb-3">
                                        <label for="example-tel-input" class="form-label">Price</label>
                                        <input class="form-control" type="tel" value="{{ $payment->price }}"
                                            name="price" id="price">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-password-input" class="form-label">Prosentanse(%)</label>
                                        <input class="form-control" type="text" value="{{ $payment->prosentase }}"
                                            name="prosentase" id="prosentase">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-password-input" class="form-label">Payment</label>
                                        <input class="form-control" type="text" value="{{ $payment->pay }}" readonly
                                            name="pay" id="pay">
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
