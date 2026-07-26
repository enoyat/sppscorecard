@csrf

<div class="row">

    {{-- Judul Ticket --}}
    <div class="col-md-12 mb-3">
        <label class="form-label">
            Judul Ticket <span class="text-danger">*</span>
        </label>

        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
            value="{{ old('title', $ticket->title ?? '') }}" placeholder="Masukkan judul ticket">

        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    {{-- Deskripsi --}}
    <div class="col-md-12 mb-3">

        <label class="form-label">
            Deskripsi <span class="text-danger">*</span>
        </label>

        <textarea name="description" rows="6" class="form-control @error('description') is-invalid @enderror"
            placeholder="Jelaskan permasalahan secara lengkap">{{ old('description', $ticket->description ?? '') }}</textarea>

        @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

    {{-- Priority --}}
    <div class="col-md-4 mb-3">

        <label class="form-label">
            Priority
        </label>

        <select name="priority" class="form-select @error('priority') is-invalid @enderror">

            <option value="">Pilih Priority</option>

            <option value="Low"
                {{ old('priority', isset($ticket) ? $ticket->priority : '') == 'Low' ? 'selected' : '' }}>
                Low
            </option>

            <option value="Medium"
                {{ old('priority', isset($ticket) ? $ticket->priority : '') == 'Medium' ? 'selected' : '' }}>
                Medium
            </option>

            <option value="High"
                {{ old('priority', isset($ticket) ? $ticket->priority : '') == 'High' ? 'selected' : '' }}>
                High
            </option>

        </select>

        @error('priority')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

    {{-- Assign Teknisi --}}
    <div class="col-md-4 mb-3">

        <label class="form-label">

            Assign Site

        </label>

        <select name="idsitename" class="form-select">
            <option value ="999" selected>SITENAME SPP</option>
            {{-- @foreach ($sites as $site)

            <option value="{{ $site->id }}">

                {{ $site->namasitename }}

            </option>

            @endforeach --}}

        </select>

        @error('site_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

    {{-- Status --}}
    <div class="col-md-4 mb-3">

        <label class="form-label">
            Status
        </label>

        <select name="status" class="form-select @error('status') is-invalid @enderror">

            <option value="Open"
                {{ old('status', isset($ticket) ? $ticket->status : '') == 'Open' ? 'selected' : '' }}>
                Open
            </option>
            <option value="Progress"
                {{ old('status', isset($ticket) ? $ticket->status : '') == 'Progress' ? 'selected' : '' }}>
                Progress
            </option>
            <option value="Closed"
                {{ old('status', isset($ticket) ? $ticket->status : '') == 'Closed' ? 'selected' : '' }}>
                Closed
            </option>


        </select>

        @error('status')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

    {{-- Lampiran --}}
    <div class="col-md-12 mb-3">

        <label class="form-label">

            Lampiran (Optional)

        </label>

        <input type="file" name="attachment" class="form-control @error('attachment') is-invalid @enderror">

        <small class="text-muted">

            Format:
            PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG, ZIP
            (Maksimal 5 MB)

        </small>

        @error('attachment')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        @isset($ticket)

            @if (!empty($ticket->attachment))
                <div class="mt-2">

                    <a href="{{ asset('storage/ticket-attachments/' . $ticket->attachment) }}" target="_blank"
                        class="btn btn-outline-primary btn-sm">

                        <i class="fas fa-paperclip"></i>

                        Lihat Lampiran

                    </a>

                </div>
            @endif

        @endisset

    </div>

</div>

<hr>

<div class="d-flex justify-content-between">

    <a href="{{ route('tickets.index') }}" class="btn btn-secondary">

        <i class="fas fa-arrow-left"></i>

        Kembali

    </a>

    <button type="submit" class="btn btn-primary">

        <i class="fas fa-save"></i>

        Simpan Ticket

    </button>

</div>
