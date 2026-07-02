@extends('layouts.master')

@section('title', 'Edit Ticket')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-3">

        <div class="col-md-6">

            <h4 class="mb-0">
                <i class="fas fa-edit"></i>
                Edit Ticket
            </h4>

            <small class="text-muted">
                Perbarui informasi ticket.
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

    {{-- Validation Error --}}
    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Terjadi kesalahan.</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="row">

        {{-- Form --}}
        <div class="col-lg-8">

            <div class="card shadow-sm">

                <div class="card-header bg-warning">

                    <i class="fas fa-ticket-alt"></i>

                    Form Edit Ticket

                </div>

                <div class="card-body">

                    <form
                        action="{{ route('tickets.update',$ticket->id) }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        @include('tickets.form')

                    </form>

                </div>

            </div>

        </div>

        {{-- Informasi Ticket --}}
        <div class="col-lg-4">

            <div class="card shadow-sm">

                <div class="card-header">

                    Informasi Ticket

                </div>

                <div class="card-body">

                    <table class="table table-sm">

                        <tr>

                            <th width="120">

                                No Ticket

                            </th>

                            <td>

                                #{{ $ticket->id }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Pembuat

                            </th>

                            <td>

                                {{ $ticket->user->name ?? '-' }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Dibuat

                            </th>

                            <td>

                                {{ $ticket->created_at->format('d M Y H:i') }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Diupdate

                            </th>

                            <td>

                                {{ $ticket->updated_at->format('d M Y H:i') }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Status

                            </th>

                            <td>

                                @switch($ticket->status)

                                    @case('Open')

                                        <span class="badge bg-primary">

                                            Open

                                        </span>

                                    @break

                                    @case('Progress')

                                        <span class="badge bg-warning text-dark">

                                            Progress

                                        </span>

                                    @break

                                    @case('Closed')

                                        <span class="badge bg-success">

                                            Closed

                                        </span>

                                    @break

                                @endswitch

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Priority

                            </th>

                            <td>

                                @switch($ticket->priority)

                                    @case('High')

                                        <span class="badge bg-danger">

                                            High

                                        </span>

                                    @break

                                    @case('Medium')

                                        <span class="badge bg-warning text-dark">

                                            Medium

                                        </span>

                                    @break

                                    @case('Low')

                                        <span class="badge bg-success">

                                            Low

                                        </span>

                                    @break

                                @endswitch

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

            {{-- Lampiran --}}
            @if(!empty($ticket->attachment))

            <div class="card shadow-sm mt-3">

                <div class="card-header">

                    Lampiran

                </div>

                <div class="card-body text-center">

                    <a href="{{ asset('storage/ticket-attachments/'.$ticket->attachment) }}"
                       target="_blank"
                       class="btn btn-outline-primary">

                        <i class="fas fa-paperclip"></i>

                        Lihat Lampiran

                    </a>

                </div>

            </div>

            @endif

        </div>

    </div>

</div>

@endsection