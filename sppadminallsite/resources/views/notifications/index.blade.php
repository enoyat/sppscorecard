@extends('layouts.master')

@section('title','Semua Notifikasi')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">

        <h4>

            <i class="fas fa-bell"></i>

            Semua Notifikasi

        </h4>

        <div>

            <a href="{{ route('notifications.unread') }}" class="btn btn-warning">

                Belum Dibaca

                <span class="badge bg-danger">

                    {{ $unreadCount }}

                </span>

            </a>

        </div>

    </div>

    <div class="card">

        <div class="table-responsive">

            <table class="table table-hover">

                <thead>

                    <tr>

                        <th>Pesan</th>

                        <th>Status</th>

                        <th>Waktu</th>

                        <th width="220">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($notifications as $notification)

                    <tr class="{{ $notification->read_at ? '' : 'table-warning' }}">

                        <td>

                            <strong>

                                {{ $notification->data['title'] }}

                            </strong>

                            <br>

                            {{ $notification->data['message'] }}

                        </td>

                        <td>

                            @if($notification->read_at)

                            <span class="badge bg-success">

                                Sudah Dibaca

                            </span>

                            @else

                            <span class="badge bg-danger">

                                Belum Dibaca

                            </span>

                            @endif

                        </td>

                        <td>

                            {{ $notification->created_at->diffForHumans() }}

                        </td>

                        <td>

                            <a href="{{ route('notifications.show',$notification->id) }}"
                                class="btn btn-primary btn-sm">

                                Buka

                            </a>

                            @if(!$notification->read_at)
<a href="{{ route('notifications.read', $notification->id) }}" class="btn btn-success btn-sm">

                       

                            Read

                    </a>

                            @endif

                            <form class="d-inline" method="POST"
                                action="{{ route('notifications.destroy',$notification->id) }}">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="4" class="text-center">

                            Tidak ada notifikasi.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <div class="mt-3">

        {{ $notifications->links() }}

    </div>

</div>

@endsection