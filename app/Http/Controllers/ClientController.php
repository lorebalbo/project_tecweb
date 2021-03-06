<?php

namespace App\Http\Controllers;

use App\Client;
use App\Project;
use Illuminate\Http\Request;
use Log;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        //Log::info($input);

        $client = new Client();
        $client->contact_name = $input['contact_name'];
        $client->contact_surname = $input['contact_surname'];
        $client->contact_email = $input['contact_email'];
        $client->business_name = $input['business_name'];
        $client->save();

        return json_encode(['status' => 'ok']);

        //Client::create($input);

        //return redirect('/admin/client');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $input = $request->all();

        $client->contact_name = $input['contact_name'];
        $client->contact_surname = $input['contact_surname'];
        $client->contact_email = $input['contact_email'];
        $client->business_name = $input['business_name'];
        $client->save();

        return redirect('/admin/client');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        /* Controllo che il cliente non sia associato ad un progetto */
        $progetti = Project::where('client_id',$client->id)->get(); 
         
        if($progetti->isNotEmpty()){
            //LOG::info($associazioni);
            return view('clients.edit', compact('client'))->withErrors("il cliente ?? associato ad uno o pi?? progetti");
        }

        $client->delete();

        return redirect('/admin/client');
    }
}
