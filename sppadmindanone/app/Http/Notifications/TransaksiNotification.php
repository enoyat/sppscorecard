<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class TransaksiNotification extends Notification
{
    protected $judul;
    protected $pesan;
    protected $url;

    public function __construct($judul, $pesan, $url = '#')
    {
        $this->judul = $judul;
        $this->pesan = $pesan;
        $this->url = $url;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'judul' => $this->judul,
            'pesan' => $this->pesan,
            'url' => $this->url,
        ];
    }
}