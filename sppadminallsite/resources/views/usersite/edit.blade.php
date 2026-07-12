@extends('layouts.master')
@section('content')
    <form action="{{ route('usersite.update', $usersite) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label>Mechanic</label>

            <input class="form-control" value="{{ $usersite->name }}" readonly>

        </div>

        <div class="mb-3">

            @foreach ($sites as $site)
                <div class="form-check">

                    <input type="checkbox" class="form-check-input" name="site_id[]" value="{{ $site->id }}"
                        {{ in_array($site->id, $selected) ? 'checked' : '' }}>

                    <label>

                        {{ $site->namasitename }}

                    </label>

                </div>
            @endforeach

        </div>

        <button class="btn btn-success">

            Update

        </button>

    </form>
@endsection
