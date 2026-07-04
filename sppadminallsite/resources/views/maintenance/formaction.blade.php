<form action="{{ route('maintenance.actionupdate', $maintenance->id) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label class="form-label">

            Code Unit

        </label>

        <input
            type="text"
            class="form-control"
            name="kdunit"
            value="{{ $maintenance->kdunit }}"
            readonly>

    </div>

    <div class="mb-3">

        <label class="form-label">

            Mechanic

        </label>

        <input
            type="text"
            class="form-control"
            name="mechanic"
            value="{{ $maintenance->getuser->name }}"
            readonly>

    </div>

    <div class="mb-3">

        <label class="form-label">

            Shift

        </label>

        <select
            class="form-select"
            name="shift">

            <option value="1"
                {{ $maintenance->shift=='1'?'selected':'' }}>
                1
            </option>

            <option value="2"
                {{ $maintenance->shift=='2'?'selected':'' }}>
                2
            </option>

            <option value="3"
                {{ $maintenance->shift=='3'?'selected':'' }}>
                3
            </option>

        </select>

    </div>

    <div class="mb-3">

        <label class="form-label">

            HM

        </label>

        <input
            type="number"
            class="form-control"
            name="hm"
            value="{{ $maintenance->hm }}">

    </div>

    <div class="mb-3">

        <label class="form-label">

            Action Plan

        </label>

        <textarea
            class="form-control"
            rows="4"
            name="actionplan">{{ $maintenance->actionplan }}</textarea>

    </div>

    <div class="mb-3">

        <label class="form-label">

            Sparepart

        </label>

        <textarea
            class="form-control"
            rows="3"
            name="sparepart">{{ $maintenance->sparepart }}</textarea>

    </div>

    <div class="mb-3">

        <label class="form-label">

            Tanggal Mulai

        </label>

        <input
            type="datetime-local"
            class="form-control"
            name="tanggalmulai"
            value="{{ \Carbon\Carbon::parse($maintenance->tanggalmulai)->format('Y-m-d\TH:i') }}">

    </div>

    <div class="mb-3">

        <label class="form-label">

            Tanggal Selesai

        </label>

        <input
            type="datetime-local"
            class="form-control"
            name="tanggalakhir"
            value="{{ $maintenance->tanggalakhir ? \Carbon\Carbon::parse($maintenance->tanggalakhir)->format('Y-m-d\TH:i') : '' }}">

    </div>

    <div class="text-end">

        <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal">

            Tutup

        </button>

        <button
            class="btn btn-primary">

            <i class="fas fa-save"></i>

            Simpan

        </button>

    </div>

</form>