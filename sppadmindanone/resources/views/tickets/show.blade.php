@extends('layouts.master')

@section('title','Detail Ticket')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="row mb-3">

        <div class="col-md-8">

            <h3 class="mb-0">

                <i class="fas fa-ticket-alt text-primary"></i>

                {{ $ticket->title }}

            </h3>

            <small class="text-muted">

                Ticket #{{ $ticket->id }}

            </small>

        </div>

        <div class="col-md-4 text-end">

            <a href="{{ route('tickets.index') }}" class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>

                Kembali

            </a>

            <a href="{{ route('tickets.edit',$ticket->id) }}" class="btn btn-warning">

                <i class="fas fa-edit"></i>

                Edit

            </a>

        </div>

    </div>

    <div class="row">

        {{-- DETAIL --}}
        <div class="col-lg-8">

            <div class="card shadow-sm">

                <div class="card-header bg-primary text-white">

                    <i class="fas fa-info-circle"></i>

                    Detail Ticket

                </div>

                <div class="card-body">

                    <table class="table table-borderless">

                        <tr>

                            <th width="180">

                                Judul

                            </th>

                            <td>

                                {{ $ticket->title }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Deskripsi

                            </th>

                            <td>

                                {!! nl2br(e($ticket->description)) !!}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Dibuat Oleh

                            </th>

                            <td>

                                {{ $ticket->user->name }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Assign To

                            </th>

                            <td>

                                {{ optional($ticket->site)->namasitename ?? '-' }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Dibuat

                            </th>

                            <td>

                                {{ $ticket->created_at->format('d F Y H:i') }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Terakhir Update

                            </th>

                            <td>

                                {{ $ticket->updated_at->diffForHumans() }}

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

            {{-- Lampiran Ticket --}}
            @if($ticket->attachment)

            <div class="card shadow-sm mt-3">

                <div class="card-header">

                    Lampiran

                </div>

                <div class="card-body">

                    <a href="{{ asset('storage/ticket-attachments/'.$ticket->attachment) }}" target="_blank"
                        class="btn btn-outline-primary">

                        <i class="fas fa-paperclip"></i>

                        Download Lampiran

                    </a>

                </div>

            </div>

            @endif

            <div class="card shadow-sm mt-4">

                <div class="card-header">

                    <i class="fas fa-comments"></i>

                    Riwayat Percakapan

                </div>

                <div class="card-body">

                    @forelse($ticket->replies as $reply)

                    <div class="border rounded p-3 mb-3">

                        <div class="d-flex justify-content-between">

                            <div>

                                <strong>

                                    {{ $reply->user->name }}

                                </strong>

                                @if($reply->user_id == $ticket->user_id)

                                <span class="badge bg-primary">

                                    Pelapor

                                </span>

                                @elseif($ticket->pic_id == $reply->user_id)

                                <span class="badge bg-success">

                                    PIC

                                </span>

                                @endif

                            </div>

                            <small class="text-muted">

                                {{ $reply->created_at->format('d M Y H:i') }}

                            </small>

                        </div>

                        <hr>

                        {!! nl2br(e($reply->message)) !!}

                        @if($reply->attachment)

                        <hr>

                        <a href="{{ asset('storage/ticket-attachments/'.$reply->attachment) }}" target="_blank"
                            class="btn btn-outline-primary btn-sm">

                            <i class="fas fa-paperclip"></i>

                            Lampiran

                        </a>

                        @endif

                    </div>

                    @empty

                    <div class="alert alert-light">

                        Belum ada balasan.

                    </div>

                    @endforelse

                </div>

            </div>
            <!-- Reply Ticket -->
            <div class="card shadow-sm mt-4">

                <div class="card-header bg-primary text-white">

                    <i class="fas fa-reply"></i>

                    Balas Ticket

                </div>

                <div class="card-body">

                    <form action="{{ route('tickets.reply.store',$ticket->id) }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">

                                Pesan

                            </label>

                            <textarea name="message" rows="5"
                                class="form-control @error('message') is-invalid @enderror"
                                placeholder="Tulis balasan...">{{ old('message') }}</textarea>

                            @error('message')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                            @enderror

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Lampiran (Optional)

                            </label>

                            <input type="file" name="attachment"
                                class="form-control @error('attachment') is-invalid @enderror">

                            @error('attachment')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                            @enderror

                        </div>

                        <div class="text-end">

                            <button class="btn btn-primary">

                                <i class="fas fa-paper-plane"></i>

                                Kirim Balasan

                            </button>

                        </div>

                    </form>

                </div>

            </div>
        </div>

        {{-- SIDEBAR --}}
        <div class="col-lg-4">

            {{-- STATUS --}}
            <div class="card shadow-sm">

                <div class="card-header">

                    Status Ticket

                </div>

                <div class="card-body">

                    @switch($ticket->status)

                    @case('Open')

                    <span class="badge bg-primary fs-6">

                        OPEN

                    </span>

                    @break

                    @case('Progress')

                    <span class="badge bg-warning text-dark fs-6">

                        PROGRESS

                    </span>

                    @break
                    @case('Resolved')
                    <span class="badge bg-info text-dark fs-6">

                        RESOLVED

                    </span>

                    @break
                    @case('Closed')

                    <span class="badge bg-success fs-6">

                        CLOSED

                    </span>

                    @break

                    @endswitch

                </div>

            </div>

            {{-- PRIORITY --}}
            <div class="card shadow-sm mt-3">

                <div class="card-header">

                    Priority

                </div>

                <div class="card-body">

                    @switch($ticket->priority)

                    @case('High')

                    <span class="badge bg-danger fs-6">

                        HIGH

                    </span>

                    @break

                    @case('Medium')

                    <span class="badge bg-warning text-dark fs-6">

                        MEDIUM

                    </span>

                    @break

                    @case('Low')

                    <span class="badge bg-success fs-6">

                        LOW

                    </span>

                    @break

                    @endswitch

                </div>

            </div>
            <div class="card mt-3">

                <div class="card-header">

                    PIC Ticket

                </div>

                <div class="card-body">

                    @if($ticket->pic)

                    <h5>

                        <i class="fas fa-user-check text-success"></i>

                        {{ $ticket->pic->name }}

                    </h5>

                    @else

                    <span class="text-muted">

                        Belum ada PIC

                    </span>

                    @endif

                </div>

            </div>
            @if(!$ticket->pic_id)

            <form action="{{ route('tickets.claim',$ticket->id) }}" method="POST">

                @csrf

                <button class="btn btn-success w-100">

                    <i class="fas fa-hand-paper"></i>

                    Ambil Ticket

                </button>

            </form>

            @else

            <button class="btn btn-secondary w-100" disabled>

                Sudah Diambil

            </button>

            @endif

            {{-- UPDATE STATUS --}}
            @if(auth()->id() == $ticket->pic_id && $ticket->status == 'Progress')

            <form action="{{ route('tickets.resolve',$ticket) }}" method="POST">
                @csrf
                <button class="btn btn-success w-100 mt-3">
                    Tandai Selesai
                </button>
            </form>

            @endif


            @if(auth()->id() == $ticket->user_id && $ticket->status == 'Resolved')

            <form action="{{ route('tickets.reopen',$ticket) }}" method="POST">
                @csrf
                <button class="btn btn-warning w-100 mt-3">
                    Masih Bermasalah
                </button>
            </form>
<form action="{{ route('tickets.close',$ticket) }}" method="POST">
                @csrf
                <button class="btn btn-success w-100 mt-3">
                    Konfirmasi Selesai
                </button>
            </form>
            @endif
           


        </div>

    </div>

    {{-- Timeline Reply akan ditambahkan di bawah --}}

</div>

@endsection