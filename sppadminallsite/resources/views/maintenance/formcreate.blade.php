<form action="{{ route('maintenance.createstore') }}" method="POST">
    @csrf

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
        <label class="form-label">
            Mechanic
        </label>

        <select class="form-select" name="iduser" required>
            <option value="">-- Pilih Mechanic --</option>

            @foreach ($mechanics as $mechanic)
                <option value="{{ $mechanic->id }}" {{ old('iduser') == $mechanic->id ? 'selected' : '' }}>
                    {{ $mechanic->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">
            Shift
        </label>
        <select class="form-select" name="shift" required>
            <option value="">-- Pilih Shift --</option>
            <option value="1" {{ old('shift') == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ old('shift') == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ old('shift') == '3' ? 'selected' : '' }}>3</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">
            HM
        </label>
        <input type="number" class="form-control" name="hm" value="{{ old('hm') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">
            Action Plan
        </label>
        <textarea class="form-control" rows="4" name="actionplan">{{ old('actionplan') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">
            Sparepart
        </label>
        <textarea class="form-control" rows="3" name="sparepart">{{ old('sparepart') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">
            Tanggal Mulai
        </label>
        <input type="datetime-local" class="form-control" name="tanggalmulai" value="{{ old('tanggalmulai') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">
            Tanggal Selesai
        </label>
        <input type="datetime-local" class="form-control" name="tanggalakhir" value="{{ old('tanggalakhir') }}">
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
