@extends('layouts.master')

@section('title') @lang('translation.Basic_Elements') @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Create Delivery @endslot
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
                                    <select class="form-select" aria-label="Default select example" name="idcbu" id="idcbu">
                                        @foreach ($cbu as $itemcbu)
                                        <option value="{{ $itemcbu->id }}">{{ $itemcbu->namacbu }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Region</label>
                                    <select class="form-select" aria-label="Default select example" name="idregion" id="idregion">

                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Site Name</label>
                                    <select class="form-select" aria-label="Default select example" name="idsitename" id="idsitename">

                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Serial Number</label>
                                    <input class="form-control" type="text" value="hunter2" name="serialnumber" id="serialnumber">
                                </div>
                                <div class="mb-3">
                                    <label for="example-url-input" class="form-label">Forklif Type</label>
                                    <input class="form-control" type="url" value="https://getbootstrap.com" name="idforkliftype" id="idforkliftype">
                                </div>
                                <div class="mb-3">
                                    <label for="example-tel-input" class="form-label">Capacity</label>
                                    <input class="form-control" type="tel" value="1-(555)-555-5555" name="capacity" id="capacity">
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Mas Height (m)</label>
                                    <input class="form-control" type="text" value="hunter2" name="masheight" id="masheight">
                                </div>


                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mt-3 mt-lg-0">
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">Estimated Delivery</label>
                                    <input class="form-control" type="date" value="2019-08-19" name="dateestimated" id="dateestimated">
                                </div>
                                <div class="mb-3">
                                    <label for="example-month-input" class="form-label">Reason of Lapse</label>
                                    <input class="form-control" type="text" value="" name="reason" id="reason">
                                </div>
                                <div class="mb-3">
                                    <label for="example-week-input" class="form-label">Mitigation Plant</label>
                                    <input class="form-control" type="week" value="2019-W33" name="mitigationplan" id="mitigationplan">
                                </div>
                                <div class="mb-3">
                                    <label for="example-time-input" class="form-label">Actual Delivery</label>
                                    <input class="form-control" type="date" value="2019-08-19" name="dateactual" id="dateactual">
                                </div>
                                <div class="mb-3">
                                    <label for="example-color-input" class="form-label">Confirmation by Plant</label>
                                    <input class="form-control" type="text" value="" name="confirmationplan" id="confirmationplan">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status SPP</label>
                                    <select class="form-select" name="statusspp" id="statusspp">
                                        <option value="">Select</option>
                                        <option value="OPEN">OPEN</option>
                                        <option value="CLOSE">CLOSE</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status Customer</label>
                                    <select class="form-select" name="statuscustomer" id="statuscustomer">
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
    $("#idcbu").change(function() {
        $.ajax({
            url: "{{ route('delivery.getregion') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "idcbu": $('#idcbu').val()
            },
            success: function(data) {
                $('#idregion').html(data);
            }
        });
    });
    $("#idregion").change(function() {
        $.ajax({
            url: "{{ route('delivery.getsitename') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "idregion": $('#idregion').val()
            },
            success: function(data) {
                $('#idsitename').html(data);
            }
        });
    }
    );
    
</script>





@endsection