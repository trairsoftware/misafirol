<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tickets = Ticket::orderBy('id', 'ASC')->get();

        return response()->json([
            'status'  => true,
            'tickets' => $tickets
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $ticket = Ticket::create($request->all());

        return response()->json([
            'status'  => true,
            'message' => 'Post Created Successfully',
            'ticket'  => $ticket
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Ticket $ticket
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Ticket $ticket)
    {
        $ticket->update($request->all());

        return response()->json([
            'status'  => true,
            'message' => 'Updated Successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Ticket $ticket
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return response()->json([
            'status'  => true,
            'message' => "Deleted successfully!",
        ]);
    }

    public function filter($type)
    {
        $tickets = Ticket::where([
            ['status', '=', $type],
            ['is_active', '=', 1]
        ])->get();

        return response()->json([
            'status'  => true,
            'tickets' => $tickets
        ]);


    }
}
