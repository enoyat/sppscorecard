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
            Update Delivery
        @endslot
    @endcomponent


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Delivery</h4>
                </div>
                <div class="card-body p-4">

                    <form action="{{ route('delivery.update', $delivery->id) }}" method="POST">
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
                                            <option value="{{ $delivery->idcbu }}" selected>
                                                {{ $delivery->getcbu->namasitename }}</option>
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
                                            <option value="{{ $delivery->idregion }}">
                                                {{ $delivery->getregion->namasitename }}</option>
                                        </select>

                                    </div>
                                    <div class="mb-3">
                                        <label for="example-text-input" class="form-label">Site Name</label>
                                        <select class="form-select" aria-label="Default select example" name="idsitename"
                                            id="idsitename">
                                            <option value="{{ $delivery->idsitename }}">
                                                {{ $delivery->getsitename->namasitename }}</option>
                                        </select>

                                    </div>
                                    <div class="mb-3">
                                        <label for="example-password-input" class="form-label">Serial Number</label>
                                        <input class="form-control" type="text" value="{{ $delivery->serialnumber }}"
                                            name="serialnumber" id="serialnumber">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-url-input" class="form-label">Forklif Type</label>
                                        <select class="form-select" aria-label="Default select example"
                                            name="idforklifttype" id="idforklifttype">
                                            <option value="{{ $delivery->idforklifttype }}" selected>
                                                {{ $delivery->getforklifttype->namaforklifttype }}</option>
                                            <option value="">select</option>
                                            @foreach ($forklifttype as $itemforklifttype)
                                                <option value="{{ $itemforklifttype->id }}">
                                                    {{ $itemforklifttype->namaforklifttype }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-tel-input" class="form-label">Capacity</label>
                                        <input class="form-control" type="tel" value="{{ $delivery->capacity }}"
                                            name="capacity" id="capacity">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-password-input" class="form-label">Mas Height (m)</label>
                                        <input class="form-control" type="text" value="{{ $delivery->masheight }}"
                                            name="masheight" id="masheight">
                                    </div>


                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mt-3 mt-lg-0">
                                    <div class="mb-3">
                                        <label for="example-time-input" class="form-label">Date Request</label>
                                        <input class="form-control" type="date" value="{{ $delivery->daterequest }}"
                                            name="daterequest" id="daterequest">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-month-input" class="form-label">PO Number</label>
                                        <input class="form-control" type="text" value="{{ $delivery->ponumber }}"
                                            name="ponumber" id="ponumber">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-date-input" class="form-label">Estimated Delivery</label>
                                        <input class="form-control" type="date" value="{{ $delivery->dateestimated }}"
                                            name="dateestimated" id="dateestimated" onchange="days_between($(this).val(),$('#dateactual').val())">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-time-input" class="form-label">Actual Delivery</label>
                                        <input class="form-control" type="date" value="{{ $delivery->dateactual }}"
                                            name="dateactual" id="dateactual"
                                            onchange="days_between($(this).val(),$('#dateestimated').val())">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-month-input" class="form-label">Days of Lapse</label>
                                        <input class="form-control" type="text" value="{{ $delivery->daysoflapse }}"
                                            name="daysoflapse" id="daysoflapse" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-month-input" class="form-label">Reason of Lapse</label>
                                        <input class="form-control" type="text" value="{{ $delivery->reason }}"
                                            name="reason" id="reason">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Status SPP</label>
                                        <select class="form-select" name="statusspp" id="statusspp">
                                            <option value="{{ $delivery->statusspp }}">{{ $delivery->statusspp }}
                                            </option>
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
        function days_between(date1, date2) {
            $("#daysoflapse").val('');
            // The number of milliseconds in one day
            var ONE_DAY = 1000 * 60 * 60 * 24;
            // Convert both dates to milliseconds
            var date1_ms = new Date(date1).getTime();
            var date2_ms = new Date(date2).getTime();
            // Calculate the difference in milliseconds
            var difference_ms = Math.abs(date1_ms - date2_ms);

            $("#daysoflapse").val(Math.round(difference_ms / ONE_DAY));
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
