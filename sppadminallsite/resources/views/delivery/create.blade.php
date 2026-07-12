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
            Create Delivery
        @endslot
    @endcomponent


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Delivery</h4>
                </div>
                <div class="card-body p-4">

                    <form action="{{ route('delivery.store') }}" method="POST">
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
                                        {{ Session::get('runidcbu') }}
                                        <select class="form-select" aria-label="Default select example" name="idcbu"
                                            id="idcbu">
                                            <option value="" selected>select</option>
                                            @foreach ($cbu as $itemcbu)
                                                <option value="{{ $itemcbu->id }}">{{ $itemcbu->namasitename }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="mb-3">
                                        <label for="example-text-input" class="form-label">Region</label>
                                        <select class="form-select" aria-label="Default select example" name="idregion"
                                            id="idregion">

                                        </select>

                                    </div>
                                    <div class="mb-3">
                                        <label for="example-text-input" class="form-label">Site Name</label>
                                        <select class="form-select" aria-label="Default select example" name="idsitename"
                                            id="idsitename">

                                        </select>

                                    </div>
                                    <div class="mb-3">
                                        <label for="example-password-input" class="form-label">Serial Number</label>
                                        <input class="form-control" type="text" value="" name="serialnumber"
                                            id="serialnumber">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-url-input" class="form-label">Forklif Type</label>
                                        <select class="form-select" aria-label="Default select example"
                                            name="idforklifttype" id="idforklifttype">
                                            <option value="" selected>select</option>
                                            @foreach ($forklifttype as $itemforklifttype)
                                                <option value="{{ $itemforklifttype->id }}">
                                                    {{ $itemforklifttype->namaforklifttype }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-tel-input" class="form-label">Capacity</label>
                                        <input class="form-control" type="tel" value="" name="capacity"
                                            id="capacity">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-password-input" class="form-label">Mast (Stage)</label>
                                        <input class="form-control" type="text" value="" name="mast"
                                            id="mast">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-password-input" class="form-label">Mast Height (meter)</label>
                                        <input class="form-control" type="text" value="" name="masheight"
                                            id="masheight">
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mt-3 mt-lg-0">
                                    <div class="mb-3">
                                        <label for="example-time-input" class="form-label">Date Request</label>
                                        <input class="form-control" type="date" value="" name="daterequest"
                                            id="daterequest">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-month-input" class="form-label">PO Number</label>
                                        <input class="form-control" type="text" value="" name="ponumber"
                                            id="ponumber">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-date-input" class="form-label">Estimated Delivery</label>
                                        <input class="form-control" type="date" value="" name="dateestimated"
                                            id="dateestimated">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-time-input" class="form-label">Actual Delivery</label>
                                        <input class="form-control" type="date" value="" name="dateactual"
                                            id="dateactual"
                                            onchange="days_between($(this).val(),$('#dateestimated').val())">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-month-input" class="form-label">Days of Lapse</label>
                                        <input class="form-control" type="text" value="" name="daysoflapse"
                                            id="daysoflapse">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-month-input" class="form-label">Reason of Lapse</label>
                                        <input class="form-control" type="text" value="" name="reason"
                                            id="reason">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Status SPP</label>
                                        <select class="form-select" name="statusspp" id="statusspp">
                                            <option value="">Select</option>
                                            <option value="OPEN">OPEN</option>
                                            <option value="CLOSE">CLOSE</option>
                                        </select>
                                    </div>
                                    <!-- <div class="mb-3">
                                            <label class="form-label">Status Customer</label>
                                            <select class="form-select" name="statuscustomer" id="statuscustomer">
                                                <option value="">Select</option>
                                                <option value="OPEN">OPEN</option>
                                                <option value="CLOSE">CLOSE</option>
                                            </select>
                                        </div> -->

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
        function days_between(date1, date2) {
            $("#daysoflapse").val('');
            // The number of milliseconds in one day
            var ONE_DAY = 1000 * 60 * 60 * 24;
            // Convert both dates to milliseconds
            var date1_ms = new Date(date1).getTime();
            var date2_ms = new Date(date2).getTime();
            // Calculate the difference in milliseconds
            if (date1_ms < date2_ms) {
                var difference_ms = 0;
            } else {
                var difference_ms = date1_ms - date2_ms;
            }

            if (difference_ms > 0) {

                $("#daysoflapse").val(Math.round(difference_ms / ONE_DAY));
            } else {
                difference_ms = 0;
                $("#daysoflapse").val(0);
            }


        }
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
