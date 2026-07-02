@extends('layouts.master')

@section('title','Daftar Ticket')

@section('content')

<div class="container-fluid">

    <div class="row mb-3">

        <div class="col-md-6">
            <h4 class="mb-0">
                <i class="fas fa-ticket-alt"></i>
                Ticket Helpdesk
            </h4>
        </div>

        <div class="col-md-6 text-end">
            
            @if(auth()->user()->roles_id != 1)

            <a href="{{ route('tickets.create') }}" class="btn btn-primary">

                <i class="fas fa-plus"></i>
                Tambah Ticket

            </a>

            @endif
        </div>

    </div>

    @if(session('success'))

    <div class="alert alert-success alert-dismissible fade show">

        {{ session('success') }}

        <button class="btn-close" data-bs-dismiss="alert"></button>

    </div>

    @endif


    <div class="card shadow-sm">

        <div class="card-header">

            <form method="GET" action="{{ route('tickets.index') }}">

                <div class="row">

                    <div class="col-md-4">

                        <input type="text" class="form-control" name="search" placeholder="Cari Judul Ticket..."
                            value="{{ request('search') }}">

                    </div>

                    <div class="col-md-3">

                        <select class="form-select" name="status">

                            <option value="">
                                Semua Status
                            </option>

                            <option value="Open" @selected(request('status')=='Open' )>

                                Open

                            </option>

                            <option value="Progress" @selected(request('status')=='Progress' )>

                                Progress

                            </option>
                            <option value="Resolved" @selected(request('status')=='Resolved' )>

                                Resolved

                            </option>
                            <option value="Closed" @selected(request('status')=='Closed' )>

                                Closed

                            </option>

                        </select>

                    </div>

                    <div class="col-md-3">

                        <select class="form-select" name="priority">

                            <option value="">
                                Semua Priority
                            </option>

                            <option value="Low" @selected(request('priority')=='Low' )>

                                Low

                            </option>

                            <option value="Medium" @selected(request('priority')=='Medium' )>

                                Medium

                            </option>

                            <option value="High" @selected(request('priority')=='High' )>

                                High

                            </option>

                        </select>

                    </div>

                    <div class="col-md-2 d-grid">

                        <button class="btn btn-success">

                            <i class="fas fa-search"></i>

                            Cari

                        </button>

                    </div>

                </div>

            </form>

        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th width="50">No</th>

                        <th>Judul</th>

                        <th>Pembuat</th>

                        <th>Assign</th>

                        <th>Priority</th>

                        <th>Status</th>

                        <th>Dibuat</th>

                        <th width="170">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($tickets as $ticket)

                    <tr>

                        <td>

                            {{ $loop->iteration + (($tickets->currentPage()-1) * $tickets->perPage()) }}

                        </td>

                        <td>

                            <strong>

                                {{ $ticket->title }}

                            </strong>

                            <br>

                            <small class="text-muted">

                                #{{ $ticket->id }}

                            </small>

                        </td>

                        <td>

                            {{ $ticket->user->name ?? '-' }}

                        </td>

                        <td>

                            {{ $ticket->site->namasitename ?? '-' }}

                        </td>

                        <td>

                            @if($ticket->priority=='High')

                            <span class="badge bg-danger">

                                High

                            </span>

                            @elseif($ticket->priority=='Medium')

                            <span class="badge bg-warning text-dark">

                                Medium

                            </span>

                            @else

                            <span class="badge bg-success">

                                Low

                            </span>

                            @endif

                        </td>

                        <td>

                            @if($ticket->status=='Open')

                            <span class="badge bg-primary">

                                Open

                            </span>

                            @elseif($ticket->status=='Progress')

                            <span class="badge bg-warning text-dark">

                                Progress

                            </span>
                            @elseif($ticket->status=='Resolved')

                            <span class="badge bg-info ">

                                Resolved

                            </span>
                            @else

                            <span class="badge bg-success">

                                Closed

                            </span>

                            @endif

                        </td>

                        <td>

                            {{ $ticket->created_at->format('d M Y H:i') }}

                        </td>

                        <td>

                            <div class="btn-group">

                                <a href="{{ route('tickets.show',$ticket->id) }}" class="btn btn-info btn-sm">

                                    <i class="fas fa-eye"></i>

                                </a>

                                @if(
                                auth()->id() == $ticket->user_id &&
                                $ticket->status == 'Open' &&
                                !$ticket->pic_id
                                )

                                <a href="{{ route('tickets.edit',$ticket) }}" class="btn btn-warning">

                                    Edit

                                </a>

                                @endif

                                @if(
                                auth()->id() == $ticket->user_id &&
                                $ticket->status == 'Open' &&
                                !$ticket->pic_id
                                )

                                <form action="{{ route('tickets.destroy',$ticket) }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger">

                                        Hapus

                                    </button>

                                </form>

                                @endif

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8" class="text-center">

                            Belum ada data Ticket.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="card-footer">

            {{ $tickets->links() }}

        </div>

    </div>

</div>

@endsection