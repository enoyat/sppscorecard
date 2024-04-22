<form action="{{ route('delivery.updatestatus',$delivery->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

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
        <div class="col-lg-12">
            <div class="mb-3">
                <label class="form-label">REMARK PLAN</label>
                <input type="text" class="form-control" name="remarkplan" id="remarkplan"
                    value="{{ $delivery->remarkplan }}">

            </div>
            <div class="mb-3">
                <label class="form-label">Status Customer</label>
                <select class="form-select" name="statuscustomer" id="statuscustomer">
                    <option value="{{ $delivery->statuscustomer }}">{{ $delivery->statuscustomer }}</option>
                    <option value="">Select</option>
                    <option value="OPEN">OPEN</option>
                    <option value="CLOSE">CLOSE</option>
                </select>
                <input type='hidden' name='aid' value='{{ $aid }}' />
                <input type='hidden' name='id' value='{{ $delivery->id }}' />
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-md">Submit</button>

            </div>

        </div>
    </div>

</form>
