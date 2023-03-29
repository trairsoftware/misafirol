<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function add()
    {
        if (strpos(request()->headers->get('referer'), 'client/edit') > -1) {
            session()->flashInput([]);
        }
        return view('client.add');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name'          => 'required|string',
            'short_name'    => 'required|string',
            'contact_name'  => 'string',
            'contact_no'    => 'string',
            'contact_email' => 'string',
            'max_ticket'    => 'integer',
            'is_active'     => 'boolean'
        ]);

        $attributes = $request->only([
            'name',
            'short_name',
            'contact_name',
            'contact_no',
            'contact_email',
            'max_ticket',
            'is_active'
        ]);

        Client::create($attributes);

        return redirect('client/list')->with('success', 'true');
    }

    public function list(Request $request)
    {
        $clients = Client::all();

        return view('client.list', ['clients' => $clients]);
    }

    public function edit($id)
    {
        $client = Client::find($id);

        session()->flashInput([
            'name'          => $client->name,
            'short_name'    => $client->short_name,
            'contact_name'  => $client->contact_name,
            'contact_no'    => $client->contact_no,
            'contact_email' => $client->contact_email,
            'max_ticket'    => $client->max_ticket,
            'is_active'     => $client->is_active
        ]);

        return view('client.add')->with(['client' => $client, 'action' => 'edit']);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name'          => 'required|string',
            'short_name'    => 'required|string',
            'contact_name'  => 'string',
            'contact_no'    => 'string',
            'contact_email' => 'string',
            'max_ticket'    => 'integer',
            'is_active'     => 'boolean'
        ]);

        $attributes = $request->only([
            'name',
            'short_name',
            'contact_name',
            'contact_no',
            'contact_email',
            'max_ticket',
            'is_active'
        ]);

        Client::find($id)->update($attributes);

        return redirect('client/list')->with('success', 'true');
    }

    public function delete($id)
    {
        Client::find($id)->delete();

        return redirect('client/list')->with('deleted', 'true');
    }
}
