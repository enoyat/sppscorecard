@extends('layouts.master')

@section('title', 'Tambah Ticket')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-3">

        <div class="col-md-6">
            <h4 class="mb-0">
                <i class="fas fa-plus-circle"></i>
                Tambah Ticket
            </h4>
            <small class="text-muted">
                Buat ticket baru untuk melaporkan permasalahan.
            </small>
        </div>

        <div class="col-md-6 text-end">

            <a href="{{ route('tickets.index') }}"
               class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>
                Kembali

            </a>

        </div>

    </div>

    {{-- Error Validation --}}
    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Terjadi kesalahan.</strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    {{-- Form --}}
    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">

            <i class="fas fa-ticket-alt"></i>

            Form Ticket

        </div>

        <div class="card-body">

            <form
                action="{{ route('tickets.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @include('tickets.form')

            </form>

        </div>

    </div>

</div>

@endsection