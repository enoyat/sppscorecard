@extends('layouts.master')

@section('title','Belum Dibaca')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">

        <h4>

            <i class="fas fa-envelope"></i>

            Notifikasi Belum Dibaca

        </h4>

        <a href="{{ route('notifications.index') }}" class="btn btn-secondary">

            Semua Notifikasi

        </a>

    </div>

    <div class="row">

        @forelse($notifications as $notification)

        <div class="col-md-12">

            <div class="card mb-3 border-warning">

                <div class="card-body">

                    <h5>

                        {{ $notification->data['title'] }}

                    </h5>

                    <p>

                        {{ $notification->data['message'] }}

                    </p>

                    <small>

                        {{ $notification->created_at->diffForHumans() }}

                    </small>

                    <hr>

                    <a href="{{ route('notifications.show',$notification->id) }}" class="btn btn-primary btn-sm">

                        Buka Ticket

                    </a>

                    <a href="{{ route('notifications.read', $notification->id) }}" class="btn btn-success btn-sm">

                       

                            Tandai Dibaca

                    </a>
                    
                </div>

            </div>

        </div>

        @empty

        <div class="col-12">

            <div class="alert alert-success">

                Semua notifikasi sudah dibaca.

            </div>

        </div>

        @endforelse

    </div>

    {{ $notifications->links() }}

</div>

@endsection