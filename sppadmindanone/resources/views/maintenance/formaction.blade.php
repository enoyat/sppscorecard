<form action="{{ route('maintenance.actionupdate', $maintenance->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label class="form-label">

            Code Unit

        </label>

        <input type="text" class="form-control" name="kdunit" value="{{ $maintenance->kdunit }}" readonly>

    </div>

    <div class="mb-3">

        <label class="form-label">

            Mechanic

        </label>

        <input type="text" class="form-control" name="mechanic" value="{{ $maintenance->getuser->name }}" readonly>

    </div>

    <div class="mb-3">

        <label class="form-label">

            Shift

        </label>

        <select class="form-select" name="shift">

            <option value="1" {{ $maintenance->shift == '1' ? 'selected' : '' }}>
                1
            </option>

            <option value="2" {{ $maintenance->shift == '2' ? 'selected' : '' }}>
                2
            </option>

            <option value="3" {{ $maintenance->shift == '3' ? 'selected' : '' }}>
                3
            </option>

        </select>

    </div>

    <div class="mb-3">

        <label class="form-label">

            HM

        </label>

        <input type="number" class="form-control" name="hm" value="{{ $maintenance->hm }}">

    </div>

    <div class="mb-3">

        <label class="form-label">

            Action Plan

        </label>

        <textarea class="form-control" rows="4" name="actionplan">{{ $maintenance->actionplan }}</textarea>

    </div>

    <div class="mb-3">

        <label class="form-label">

            Sparepart

        </label>

        <textarea class="form-control" rows="3" name="sparepart">{{ $maintenance->sparepart }}</textarea>

    </div>

    <div class="mb-3">

        <label class="form-label">

            Tanggal Mulai

        </label>

        <input type="datetime-local" class="form-control" name="tanggalmulai"
            value="{{ \Carbon\Carbon::parse($maintenance->tanggalmulai)->format('Y-m-d\TH:i') }}">

    </div>

    <div class="mb-3">

        <label class="form-label">

            Tanggal Selesai

        </label>

        <input type="datetime-local" class="form-control" name="tanggalakhir"
            value="{{ $maintenance->tanggalakhir ? \Carbon\Carbon::parse($maintenance->tanggalakhir)->format('Y-m-d\TH:i') : '' }}">

    </div>
    <div class="mb-3">

        <label class="form-label">

            Status Mekanik

        </label>
        <select class="form-select" name="statusmekanik" id="statusmekanik">
            <option value="{{ $maintenance->statusmekanik }}">{{ $maintenance->statusmekanik }}</option>
            <option value="">Select</option>
            <option value="OPEN">OPEN</option>
            <option value="CLOSE">CLOSE</option>
        </select>

    </div>
    <div class="mb-3">

        <label class="form-label">

            Status SPP

        </label>
        <select class="form-select" name="statusspp" id="statusspp">
            <option value="{{ $maintenance->statusspp }}">{{ $maintenance->statusspp }}</option>
            <option value="">Select</option>
            <option value="OPEN">OPEN</option>
            <option value="CLOSE">CLOSE</option>
        </select>

    </div>
    <div class="mb-3">

        <label class="form-label">

            Status Customer

        </label>
        <select class="form-select" name="statuscustomer" id="statuscustomer">
            <option value="{{ $maintenance->statuscustomer }}">{{ $maintenance->statuscustomer }}</option>
            <option value="">Select</option>
            <option value="OPEN">OPEN</option>
            <option value="CLOSE">CLOSE</option>
        </select>

    </div>
    <div class="text-end">

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

            Tutup

        </button>

        <button class="btn btn-primary">

            <i class="fas fa-save"></i>

            Simpan

        </button>

    </div>

</form>
