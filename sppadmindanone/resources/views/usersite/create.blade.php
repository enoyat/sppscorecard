<form action="{{ route('usersite.store') }}" method="POST">

    @csrf

    <div class="mb-3">
        <label>Mechanic</label>

        <select name="user_id" class="form-select">

            @foreach ($mechanics as $m)
                <option value="{{ $m->id }}">
                    {{ $m->name }}
                </option>
            @endforeach

        </select>

    </div>

    <div class="mb-3">

        <label>Site</label>

        @foreach ($sites as $site)
            <div class="form-check">

                <input class="form-check-input" type="checkbox" name="site_id[]" value="{{ $site->id }}">

                <label class="form-check-label">

                    {{ $site->namasite }}

                </label>

            </div>
        @endforeach

    </div>

    <button class="btn btn-primary">
        Simpan
    </button>

</form>
