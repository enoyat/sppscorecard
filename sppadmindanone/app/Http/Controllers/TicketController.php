<?php
namespace App\Http\Controllers;

use App\Models\MSitename;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display listing
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Ticket::with([
            'user',
            'site',
            'pic',
        ]);
    
        /*
    |--------------------------------------------------------------------------
    | Hak Akses
    |--------------------------------------------------------------------------
    */

        if ($user->roles_id != 1) {
           
            // Admin Site & Teknisi hanya melihat ticket site-nya
            if (in_array($user->roles_id, [2, 4,5])) {

                $query->where('idsitenameasal', $user->idsitename);

            }

           

        }

        /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    */

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('title', 'like', "%{$request->search}%")
                    ->orWhere('description', 'like', "%{$request->search}%");

            });

        }

        /*
    |--------------------------------------------------------------------------
    | Status
    |--------------------------------------------------------------------------
    */

        if ($request->filled('status')) {

            $query->where('status', $request->status);

        }

        /*
    |--------------------------------------------------------------------------
    | Priority
    |--------------------------------------------------------------------------
    */

        if ($request->filled('priority')) {

            $query->where('priority', $request->priority);

        }

        $tickets = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('tickets.index', compact('tickets'));
    }
    /**
     * Form Create
     */

    public function create()
    {
        $users = User::orderBy('name')->get();
        $sites = \App\Models\MSitename::orderBy('namasitename')->get();

        return view('tickets.create', compact('users', 'sites'));
    }

    /**
     * Save Ticket
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'description' => 'required',
            'priority'    => 'required',
            'idsitename'  => 'nullable|exists:sitename,id',
            'idsitenameasal' => 'nullable|exists:sitename,id',
        ]);

        $ticket = Ticket::create([
            'user_id'     => auth()->id(),
            'idsitename'  => $request->idsitename,
            'idsitenameasal' => auth()->user()->idsitename,
            'title'       => $request->title,
            'description' => $request->description,
            'priority'    => $request->priority,
            'status'      => 'Open',
        ]);

        foreach ($ticket->site->users as $user) {
            $user->notify(
                new TicketNotification(
                    $ticket,
                    "Ticket baru dari " . $ticket->user->name . " (" . $ticket->user->getsitename->namasitename . ") untuk Site " . $ticket->site->namasitename . " telah dibuat."
                )
            );
        }

        if ($request->hasFile('attachment')) {

            $file = $request->file('attachment');

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->storeAs(
                'ticket-attachments',
                $filename,
                'public'
            );

            $ticket->attachment = $filename;
            $ticket->save();
        }
        return redirect()
            ->route('tickets.index')
            ->with('success', 'Ticket berhasil dibuat.');
    }
    public function claim(Ticket $ticket)
    {
        // Sudah ada PIC
        if ($ticket->pic_id) {

            return back()->with(
                'warning',
                'Ticket sudah diambil oleh ' . $ticket->pic->name
            );

        }

        DB::beginTransaction();

        try {

            $ticket->update([

                'pic_id' => auth()->id(),

                'status' => 'Progress',

            ]);

            // Notifikasi pembuat ticket
            $ticket->user->notify(

                new TicketNotification(

                    $ticket,

                    auth()->user()->name . ' mengambil ticket Anda.'

                )

            );

            // Notifikasi semua anggota site
            foreach ($ticket->site->users as $user) {

                if ($user->id != auth()->id()) {

                    $user->notify(

                        new TicketNotification(

                            $ticket,

                            auth()->user()->name . ' menjadi PIC Ticket #' . $ticket->id

                        )

                    );

                }

            }

            DB::commit();

            return back()->with(
                'success',
                'Ticket berhasil diambil.'
            );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );

        }

    }
    /**
     * Detail Ticket
     */
    public function show(Ticket $ticket)
    {
        $ticket->load([
            'user',
            'assignee',
            'replies.user',
        ]);

        $users = User::orderBy('name')->get();

        return view('tickets.show', compact(
            'ticket',
            'users'
        ));
    }

    /**
     * Form Edit
     */

    public function edit(Ticket $ticket)
    {
        if (
            auth()->id() != $ticket->user_id &&
            auth()->user()->role != 'Admin'
        ) {
            abort(403);
        }

        if (
            $ticket->status != 'Open' ||
            $ticket->pic_id != null
        ) {

            return back()->with(
                'warning',
                'Ticket sudah diproses dan tidak dapat diubah.'
            );

        }

        $sites = MSitename::orderBy('name')->get();

        return view('tickets.edit', compact(
            'ticket',
            'sites'
        ));
    }
    /**
     * Update Ticket
     */
    public function update(Request $request, Ticket $ticket)
    {
        if (
            auth()->id() != $ticket->user_id &&
            auth()->user()->role != 'Admin'
        ) {
            abort(403);
        }

        if (
            $ticket->status != 'Open' ||
            $ticket->pic_id
        ) {

            return back()->with(
                'warning',
                'Ticket sudah diproses.'
            );

        }

        $ticket->update($request->all());

        return redirect()
            ->route('tickets.show', $ticket)
            ->with(
                'success',
                'Ticket berhasil diperbarui.'
            );
    }

    /**
     * Delete Ticket
     */
    public function destroy(Ticket $ticket)
    {
        if (
            auth()->id() != $ticket->user_id &&
            auth()->user()->role != 'Admin'
        ) {
            abort(403);
        }

        if (
            $ticket->status != 'Open' ||
            $ticket->pic_id
        ) {

            return back()->with(
                'warning',
                'Ticket sudah diproses dan tidak dapat dihapus.'
            );

        }

        $ticket->delete();

        return redirect()
            ->route('tickets.index')
            ->with(
                'success',
                'Ticket berhasil dihapus.'
            );
    }
    /**
     * Update Status
     */
    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $ticket->update([
            'status' => $request->status,
        ]);

        // Notifikasi ke pembuat ticket
        if ($ticket->user) {

            $ticket->user->notify(
                new TicketNotification(
                    $ticket,
                    "Status ticket berubah menjadi {$ticket->status}"
                )
            );
        }

        return back()->with('success', 'Status berhasil diubah.');
    }

    /**
     * Assign Teknisi
     */
    public function assign(Request $request, Ticket $ticket)
    {
        $request->validate([
            'assigned_to' => 'required|exists:users,id',
        ]);

        $ticket->update([
            'assigned_to' => $request->assigned_to,
        ]);

        $user = User::find($request->assigned_to);

        if ($user) {

            $user->notify(
                new TicketNotification(
                    $ticket,
                    "Ticket baru telah diassign kepada Anda."
                )
            );
        }

        return back()->with('success', 'Ticket berhasil diassign.');
    }

}
