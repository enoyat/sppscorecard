<form action="{{ route('maintenance.updatestatus',$maintenance->id) }}" method="POST" enctype="multipart/form-data">
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
        <div class="col-lg-6">

            <div class="mb-3">

                @if ($aid=="customer")
                <label class="form-label">Status Customer</label>
                <select class="form-select" name="statuscustomer" id="statuscustomer">
                    <option value="{{ $maintenance->statuscustomer }}">{{ $maintenance->statuscustomer }}</option>
                    <option value="">Select</option>
                    <option value="OPEN">OPEN</option>
                    <option value="CLOSE">CLOSE</option>
                </select>
                @else

                <label class="form-label">Status SPP</label>
                <select class="form-select" name="statusspp" id="statusspp">
                    <option value="{{ $maintenance->statusspp }}">{{ $maintenance->statusspp }}</option>
                    <option value="">Select</option>
                    <option value="OPEN">OPEN</option>
                    <option value="CLOSE">CLOSE</option>
                </select>
                @endif
                <input type='hidden' name='aid' value='{{ $aid }}' />
                <input type='hidden' name='id' value='{{ $maintenance->id }}' />

            </div>


            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-md">Submit</button>

            </div>

        </div>
    </div>

</form>
