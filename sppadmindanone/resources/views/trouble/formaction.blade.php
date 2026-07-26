<form action="{{ route('trouble.actionupdate', $trouble->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label class="form-label">

            Code Unit

        </label>

        <input type="text" class="form-control" name="kdunit" value="{{ $trouble->kdunit }}" readonly>

    </div>
    <div class="mb-3">

        <label class="form-label">

            Periode

        </label>

        <input type="text" class="form-control" name="periode" value="{{ $trouble->periode }}" required>


    </div>

    <div class="mb-3">

        <label class="form-label">

            Mechanic

        </label>

        <input type="text" class="form-control" name="mechanic" value="{{ $trouble->getuser->name }}" readonly>

    </div>

    <div class="mb-3">

        <label class="form-label">

            Shift

        </label>

        <select class="form-select" name="shift">

            <option value="1" {{ $trouble->shift == '1' ? 'selected' : '' }}>
                1
            </option>

            <option value="2" {{ $trouble->shift == '2' ? 'selected' : '' }}>
                2
            </option>

            <option value="3" {{ $trouble->shift == '3' ? 'selected' : '' }}>
                3
            </option>

        </select>

    </div>

    <div class="mb-3">

        <label class="form-label">

            Tanggal Mulai

        </label>

        <input type="datetime-local" class="form-control" name="tanggalmulai" id="tanggalmulai"
            value="{{ \Carbon\Carbon::parse($trouble->tanggalmulai)->format('Y-m-d\TH:i') }}">

    </div>

    <div class="mb-3">

        <label class="form-label">

            Tanggal Selesai

        </label>

        <input type="datetime-local" class="form-control" name="tanggalakhir" id="tanggalakhir"
            value="{{ $trouble->tanggalakhir ? \Carbon\Carbon::parse($trouble->tanggalakhir)->format('Y-m-d\TH:i') : '' }}">

    </div>
    <div class="mb-3">

        <label class="form-label">

            Lapse Time

        </label>

        <input type="number" class="form-control" name="lapsetime" id="lapsetime" value="{{ $trouble->lapsetime }}"
            readonly>

    </div>
    <div class="mb-3">

        <label class="form-label">

            Backup

        </label>

        <input type="number" class="form-control" name="terbackup" value="{{ $trouble->terbackup }}">

    </div>
    <div class="mb-3">

        <label class="form-label">

            Backup Minutes

        </label>

        <input type="number" class="form-control" name="backup_minutes" value="{{ $trouble->backup_minutes }}">

    </div>
    <div class="mb-3">

        <label class="form-label">

            Action Plan

        </label>

        <textarea class="form-control" rows="4" name="actionplan">{{ $trouble->actionplan }}</textarea>

    </div>

    <div class="mb-3">

        <label class="form-label">

            Sparepart

        </label>

        <textarea class="form-control" rows="3" name="sparepart">{{ $trouble->sparepart }}</textarea>

    </div>
    <div class="mb-3">

        <label class="form-label">

            Status Mekanik

        </label>
        <select class="form-select" name="statusmekanik" id="statusmekanik">
            <option value="{{ $trouble->statusmekanik }}">{{ $trouble->statusmekanik }}</option>
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
            <option value="{{ $trouble->statusspp }}">{{ $trouble->statusspp }}</option>
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
            <option value="{{ $trouble->statuscustomer }}">{{ $trouble->statuscustomer }}</option>
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
<script>
    function hitungLapseTime() {

        const mulai = document.getElementById('tanggalmulai');
        const selesai = document.getElementById('tanggalakhir');
        const lapse = document.getElementById('lapsetime');

        if (!mulai || !selesai || !lapse) return;

        if (mulai.value && selesai.value) {

            const start = new Date(mulai.value);
            const end = new Date(selesai.value);

            const diff = Math.floor((end.getTime() - start.getTime()) / 60000);

            lapse.value = diff >= 0 ? diff : 0;

        } else {
            lapse.value = 0;
        }
    }

    // Akan bekerja walaupun modal baru muncul setelah tombol Add diklik
    document.addEventListener('change', function(e) {

        if (e.target.id === 'tanggalmulai' || e.target.id === 'tanggalakhir') {
            hitungLapseTime();
        }

    });
</script>
