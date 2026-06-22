<?php
namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\UserCustomer;
use App\Notifications\TransaksiNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class TicketController extends Controller
{
  
    
    public function index()
    {
        $tickets = Ticket::null()->with('getuser')->orderby('id', 'desc')->where('idsitename', Session::get('runidsitename'))->get();

        return view('ticket.inbox', ['tickets' => $tickets]);
    }
    public function create()
    {
        return view('ticket.create');
    }

    public function read(Request $request)
    {
        $mainticket = Ticket::with('getuser')->where('id', $request->id)->orderby('id', 'desc')->first();
        $tickets    = Ticket::with('getuser')->where('parentid', $request->id)->orderby('id', 'desc')->get();
        return view('ticket.read', compact('mainticket', 'tickets'));

    }
    public function getticket($id)
    {

        $tickets  = Ticket::with('getcustomer')->where('userid', $id)->orderby('id', 'desc')->get();
        $customer = UserCustomer::with('getusers')->where('id', $id)->first();

        return view('ticket.listticket', ['tickets' => $tickets, 'customer' => $customer]);
    }

    public function inticket($id)
    {
        $tickets   = Ticket::with('getcustomer')->where('userid', $id)->orderby('id', 'desc')->get();
        $customers = UserCustomer::with('getusers')->get();
        return view('ticket.ticket', ['customers' => $customers, 'tickets' => $tickets]);
    }
    public function sendticket(Request $request)
    {

        $ticket             = new Ticket();
        $ticket->userid     = Auth::user()->id;
        $ticket->subject    = $request->subject;
        $ticket->message    = $request->message;
        $ticket->idsitename = $request->search;
        $ticket->type       = '0';
        $ticket->status     = 'unread';
        $ticket->save();

        $admins = User::where('roles_id', '1')->get();

        foreach ($admins as $admin) {
            $admin->notify(
                new TransaksiNotification(
                    'Ticket Baru Dari ' . Auth::user()->name,
                    'Subject : ' . $ticket->subject . ' telah dibuat',
                    route('ticket.index')
                )
            );
        }
        return redirect()->route('ticket.index');
    }
    public function replyticket(Request $request)
    {

        $ticket          = new Ticket();
        $ticket->userid  = Auth::user()->id;
        $ticket->subject = $request->subject;
        $ticket->message = $request->message;
        if (Auth::user()->roles_id == '1' || Auth::user()->roles_id == '2') {
            $mainticket             = Ticket::find($request->parentid);
            $mainticket->duedate    = $request->duedate;
            $mainticket->actualdate = $request->actualdate;
            $mainticket->save();

            $notification = auth()
                ->user()
                ->notifications()
                ->find($id);

            if ($notification) {
                $notification->markAsRead();
            }
        }
        $ticket->type     = '0';
        $ticket->status   = 'open';
        $ticket->parentid = $request->parentid;
        $ticket->datepost = date('Y-m-d H:i:s');

        $ticket->save();
        return redirect()->back();
    }
    public function clearticket($id)
    {
        $tickets = Ticket::where('userid', $id)->delete();
        return redirect()->back();
    }
    public function close(Request $request)
    {
        $ticket         = Ticket::find($request->id);
        $ticket->status = 'close';
        $ticket->save();
        return redirect()->route('ticket.index');
    }
}
