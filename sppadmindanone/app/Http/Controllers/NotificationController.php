<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Daftar semua notifikasi
     */
    public function index()
    {
        $notifications = auth()->user()
            ->notifications()
            ->latest()
            ->paginate(15);

        $unreadCount = auth()->user()
            ->unreadNotifications()
            ->count();

        return view('notifications.index', compact(
            'notifications',
            'unreadCount'
        ));
    }

    public function unread()
    {
       
        $notifications = auth()->user()
            ->unreadNotifications()
            ->latest()
            ->paginate(15);

        $unreadCount = auth()->user()
            ->unreadNotifications()
            ->count();
    
        return view('notifications.unread', compact(
            'notifications',
            'unreadCount'
        ));
    }

    /**
     * Lihat notifikasi dan redirect ke Ticket
     */
    public function show($id)
    {
        $notification = Auth::user()
            ->notifications()
            ->findOrFail($id);

        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        return redirect($notification->data['url']);
    }

    /**
     * Tandai satu notifikasi sebagai sudah dibaca
     */
    public function read($id)
    {
        $notification = Auth::user()
            ->notifications()
            ->findOrFail($id);

        $notification->markAsRead();

        return back()->with(
            'success',
            'Notifikasi berhasil ditandai sudah dibaca.'
        );
    }

    /**
     * Tandai semua notifikasi sebagai sudah dibaca
     */
    public function readAll()
    {
        Auth::user()
            ->unreadNotifications
            ->markAsRead();

        return back()->with(
            'success',
            'Semua notifikasi berhasil ditandai sudah dibaca.'
        );
    }

    /**
     * Hapus satu notifikasi
     */
    public function destroy($id)
    {
        $notification = Auth::user()
            ->notifications()
            ->findOrFail($id);

        $notification->delete();

        return back()->with(
            'success',
            'Notifikasi berhasil dihapus.'
        );
    }

    /**
     * Hapus seluruh notifikasi
     */
    public function destroyAll()
    {
        Auth::user()
            ->notifications()
            ->delete();

        return back()->with(
            'success',
            'Semua notifikasi berhasil dihapus.'
        );
    }
}
