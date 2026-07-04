<form action="{{ route('trouble.actionupdate', $trouble->id) }}"
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
            value="{{ $trouble->kdunit }}"
            readonly>

    </div>
 <div class="mb-3">

        <label class="form-label">

            Periode 

        </label>

        <input
            type="text"
            class="form-control"
            name="periode"
            value="{{ $trouble->periode }}" required>
            

    </div>

    <div class="mb-3">

        <label class="form-label">

            Mechanic

        </label>

        <input
            type="text"
            class="form-control"
            name="mechanic"
            value="{{ $trouble->getuser->name }}"
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
                {{ $trouble->shift=='1'?'selected':'' }}>
                1
            </option>

            <option value="2"
                {{ $trouble->shift=='2'?'selected':'' }}>
                2
            </option>

            <option value="3"
                {{ $trouble->shift=='3'?'selected':'' }}>
                3
            </option>

        </select>

    </div>

    <div class="mb-3">

        <label class="form-label">

            Lapse Time

        </label>

        <input
            type="number"
            class="form-control"
            name="lapsetime"
            value="{{ $trouble->lapsetime }}">

    </div>
<div class="mb-3">

        <label class="form-label">

            Backup

        </label>

        <input
            type="number"
            class="form-control"
            name="terbackup"
            value="{{ $trouble->terbackup }}">

    </div>
    <div class="mb-3">

        <label class="form-label">

            Backup Minutes

        </label>

        <input
            type="number"
            class="form-control"
            name="backup_minutes"
            value="{{ $trouble->backup_minutes }}">

    </div>
    <div class="mb-3">

        <label class="form-label">

            Action Plan

        </label>

        <textarea
            class="form-control"
            rows="4"
            name="actionplan">{{ $trouble->actionplan }}</textarea>

    </div>

    <div class="mb-3">

        <label class="form-label">

            Sparepart

        </label>

        <textarea
            class="form-control"
            rows="3"
            name="sparepart">{{ $trouble->sparepart }}</textarea>

    </div>

    <div class="mb-3">

        <label class="form-label">

            Tanggal Mulai

        </label>

        <input
            type="datetime-local"
            class="form-control"
            name="tanggalmulai"
            value="{{ \Carbon\Carbon::parse($trouble->tanggalmulai)->format('Y-m-d\TH:i') }}">

    </div>

    <div class="mb-3">

        <label class="form-label">

            Tanggal Selesai

        </label>

        <input
            type="datetime-local"
            class="form-control"
            name="tanggalakhir"
            value="{{ $trouble->tanggalakhir ? \Carbon\Carbon::parse($trouble->tanggalakhir)->format('Y-m-d\TH:i') : '' }}">

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