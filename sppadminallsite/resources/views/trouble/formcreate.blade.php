<form action="{{ route('trouble.createstore') }}" method="POST">
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="mb-3">
        <label class="form-label">
            Mechanic
        </label>

        <select class="form-select" name="kdunit" required>
            <option value="">-- Pilih Unit --</option>

            @foreach ($units as $unit)
                <option value="{{ $unit->kdunit }}">
                    {{ $unit->kdunit }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Periode</label>
        <input type="month" class="form-control" name="periode" value="{{ old('periode', date('Y-m')) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Mechanic</label>

        <select class="form-select select2" name="iduser" required>
            <option value="">-- Pilih Mechanic --</option>

            @foreach ($mechanics as $mechanic)
                <option value="{{ $mechanic->id }}" {{ old('iduser') == $mechanic->id ? 'selected' : '' }}>
                    {{ $mechanic->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Shift</label>

        <select class="form-select" name="shift" required>
            <option value="">-- Pilih Shift --</option>
            <option value="1" {{ old('shift') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ old('shift') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ old('shift') == '3' ? 'selected' : '' }}>3</option>
        </select>
    </div>


    <div class="mb-3">
        <label class="form-label">Tanggal Mulai</label>
        <input type="datetime-local" class="form-control" id="tanggalmulai" name="tanggalmulai"
            value="{{ old('tanggalmulai') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Tanggal Selesai</label>
        <input type="datetime-local" class="form-control" id="tanggalakhir" name="tanggalakhir"
            value="{{ old('tanggalakhir') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Lapse Time (Menit)</label>
        <input type="number" class="form-control" id="lapsetime" name="lapsetime" value="{{ old('lapsetime', 0) }}"
            readonly>
    </div>
    <div class="mb-3">
        <label class="form-label">Backup</label>
        <input type="number" class="form-control" name="terbackup" value="{{ old('terbackup', 0) }}" min="0">
    </div>

    <div class="mb-3">
        <label class="form-label">Backup Minutes</label>
        <input type="number" class="form-control" name="backup_minutes" value="{{ old('backup_minutes', 0) }}"
            min="0">
    </div>

    <div class="mb-3">
        <label class="form-label">Action Plan</label>
        <textarea class="form-control" rows="4" name="actionplan">{{ old('actionplan') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Sparepart</label>
        <textarea class="form-control" rows="3" name="sparepart">{{ old('sparepart') }}</textarea>
    </div>

    <div class="mb-3">

        <label class="form-label">

            Status Mekanik

        </label>
        <select class="form-select" name="statusmekanik" id="statusmekanik">

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

            <option value="">Select</option>
            <option value="OPEN">OPEN</option>
            <option value="CLOSE">CLOSE</option>
        </select>

    </div>

    <div class="text-end">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Tutup
        </button>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i>
            Simpan
        </button>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            dropdownParent: $('#staticBackdrop'),
            width: '100%'
        });
    });


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
