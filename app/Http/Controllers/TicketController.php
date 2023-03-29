<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Carbon\Carbon;
class TicketController extends Controller
{
    public function add()
    {
        if (strpos(request()->headers->get('referer'), 'ticket/edit') > -1) {
            session()->flashInput([]);
        }
        return view('ticket.detail');
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'ticket_owner' => 'required|string|max:120',
            'company' => 'required|string|max:120',
            'status' => 'required|in:pending,in_progress,closed',
            'is_active' => 'required|boolean',
            'ticket_manager' => 'string',
            'priority' => 'integer|in:1,2,3'
        ]);

        $attributes = $request->only([
            'title',
            'body',
            'ticket_owner',
            'company',
            'status',
            'is_active',
            'ticket_manager',
            'estimated_deadline',
            'priority'
        ]);

        $date = Carbon::now()->format('Y-m-d');
        
        if($request->ticket_manager && $request->status !== 'pending'){
            $attributes['started_date'] = $date;
        }
        Ticket::create($attributes);
        return redirect('ticket/list')->with('success', 'true');
    }

    public function list(Request $request) {

        $tickets = Ticket::orderBy('id', 'ASC')->get();
        return view('ticket.list', ['tickets' => $tickets]);
    }

    public function detail($id) {

        $ticket = Ticket::find($id);

        session()->flashInput([
            'company' => $ticket->company,
            'ticket_owner' => $ticket->ticket_owner,
            'title' => $ticket->title,
            'body' => $ticket->body,
            'status' => $ticket->status,
            'is_active' => $ticket->is_active,
            'ticket_manager' => $ticket->ticket_manager,
            'priority' => $ticket->priority,
            'estimated_deadline' => $ticket->estimated_deadline
        ]);

        return view('ticket.detail')->with(['ticket' => $ticket, 'action' => 'edit']);
    }

    public function update($id, Request $request) {

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'ticket_owner' => 'required|string|max:120',
            'company' => 'required|string|max:120',
            'status' => 'required|in:pending,in_progress,closed',
            'is_active' => 'required|boolean',
            'ticket_manager' => 'string',
            'priority' => 'integer|in:1,2,3'
        ]);

        $attributes = $request->only([
            'title',
            'body',
            'description',
            'ticket_owner',
            'company',
            'status',
            'is_active',
            'ticket_manager',
            'estimated_deadline',
            'priority'
        ]);

        $ticket = Ticket::find($id);
        $date = Carbon::now()->format('Y-m-d');

        if($request->ticket_manager && $request->status !== 'pending'){

            if(!$ticket->started_date){
                $attributes['started_date'] = $date;
            }
        }
        Ticket::find($id)->update($attributes);
        return redirect('ticket/list')->with('success', 'true');
    }
}

