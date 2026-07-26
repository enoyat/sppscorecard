<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use App\Notifications\TicketNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketReplyController extends Controller
{
    /**
     * Menyimpan balasan ticket
     */
    public function store(Request $request, Ticket $ticket)
    {
        $request->validate([
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:5120|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,zip'
        ]);

        DB::beginTransaction();

        try {

            $reply = new TicketReply();

            $reply->ticket_id = $ticket->id;
            $reply->user_id = Auth::id();
            $reply->message = $request->message;

            if ($request->hasFile('attachment')) {

                $file = $request->file('attachment');

                $filename = time().'_'.$file->getClientOriginalName();

                $file->storeAs(
                    'ticket-attachments',
                    $filename,
                    'public'
                );

                $reply->attachment = $filename;
            }

            $reply->save();

            /**
             * jika ticket masih Open
             * otomatis menjadi Progress
             */
            if ($ticket->status == 'Open') {

                $ticket->status = 'Progress';
                $ticket->save();

            }

            /**
             * Kirim notifikasi
             */

            // jika yang reply adalah pembuat ticket
            if (Auth::id() == $ticket->user_id) {

                if ($ticket->assigned_to) {

                    $receiver = User::find($ticket->assigned_to);

                    if ($receiver) {

                        $receiver->notify(
                            new TicketNotification(
                                $ticket,
                                Auth::user()->name .
                                " membalas ticket : " .
                                $ticket->title
                            )
                        );

                    }

                }

            } else {

                // jika yang reply teknisi

                $receiver = User::find($ticket->user_id);

                if ($receiver) {

                    $receiver->notify(
                        new TicketNotification(
                            $ticket,
                            Auth::user()->name .
                            " membalas ticket : " .
                            $ticket->title
                        )
                    );

                }

            }

            DB::commit();

            return redirect()
                ->route('tickets.show', $ticket->id)
                ->with('success', 'Balasan berhasil dikirim.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );

        }
    }

    /**
     * Edit Reply
     */
    public function edit(TicketReply $reply)
    {
        return view(
            'tickets.reply-edit',
            compact('reply')
        );
    }

    /**
     * Update Reply
     */
    public function update(Request $request, TicketReply $reply)
    {
        $request->validate([
            'message' => 'required'
        ]);

        $reply->update([

            'message' => $request->message

        ]);

        return redirect()
            ->route(
                'tickets.show',
                $reply->ticket_id
            )
            ->with(
                'success',
                'Balasan berhasil diperbarui.'
            );
    }

    /**
     * Hapus Reply
     */
    public function destroy(TicketReply $reply)
    {

        if ($reply->attachment) {

            $path = public_path(
                'storage/ticket-attachments/' .
                $reply->attachment
            );

            if (file_exists($path)) {

                unlink($path);

            }

        }

        $ticket = $reply->ticket_id;

        $reply->delete();

        return redirect()
            ->route(
                'tickets.show',
                $ticket
            )
            ->with(
                'success',
                'Balasan berhasil dihapus.'
            );
    }
     public function resolve(Ticket $ticket)
    {
        // Hanya PIC atau Admin
        if (
            Auth::id() != $ticket->pic_id &&
            ! Auth::user()->hasRole('Admin')
        ) {
            abort(403, 'Anda tidak berhak melakukan aksi ini.');
        }

        if ($ticket->status != 'Progress') {

            return back()->with(
                'warning',
                'Ticket tidak dapat diubah menjadi Resolved.'
            );
        }

        $ticket->update([
            'status' => 'Resolved',
        ]);

        // Notifikasi ke pembuat ticket
        $ticket->user->notify(
            new TicketNotification(
                $ticket,
                'Ticket telah diselesaikan oleh ' . $ticket->pic->name .
                '. Silakan lakukan konfirmasi.'
            )
        );

        return back()->with(
            'success',
            'Ticket berhasil ditandai sebagai Resolved.'
        );
    }
    public function reopen(Ticket $ticket)
    {
        // Hanya pelapor atau Admin
        if (
            Auth::id() != $ticket->user_id &&
            ! Auth::user()->hasRole('Admin')
        ) {
            abort(403, 'Anda tidak berhak melakukan aksi ini.');
        }

        if ($ticket->status != 'Resolved') {

            return back()->with(
                'warning',
                'Ticket tidak dapat di-reopen.'
            );
        }

        $ticket->update([
            'status' => 'Progress',
        ]);

        // Notifikasi ke PIC
        if ($ticket->pic) {

            $ticket->pic->notify(
                new TicketNotification(
                    $ticket,
                    'Ticket di-reopen oleh ' . $ticket->user->name .
                    '. Permasalahan masih belum selesai.'
                )
            );

        }

        return back()->with(
            'success',
            'Ticket berhasil di-reopen.'
        );
    }
     public function close(Ticket $ticket)
    {
        // Hanya pelapor atau Admin
        if (
            Auth::id() != $ticket->user_id &&
            ! Auth::user()->hasRole('Admin')
        ) {
            abort(403, 'Anda tidak berhak melakukan aksi ini.');
        }

        if ($ticket->status != 'Resolved') {

            return back()->with(
                'warning',
                'Ticket tidak dapat diubah menjadi Closed.'
            );
        }

        $ticket->update([
            'status' => 'Closed',
        ]);

        // Notifikasi ke pembuat ticket
        $ticket->user->notify(
            new TicketNotification(
                $ticket,
                'Ticket telah diselesaikan oleh ' . $ticket->pic->name .
                '. Terima Kasih.'
            )
        );

        return back()->with(
            'success',
            'Ticket berhasil ditandai sebagai Closed.'
        );
    }
}