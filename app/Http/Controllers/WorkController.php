<?php

namespace App\Http\Controllers;

use App\Work;
use App\Project;
use App\UserProject;
use Log;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        // Ottengo l'id dell'utente corrente
        $userId = Auth::id();

        $works = DB::table('works')
        ->select('projects.name','works.description','works.hour','works.date')
        ->join('users','users.id','works.user_id')
        ->join('projects','projects.id','works.project_id')
        ->where('works.user_id', $userId)
        ->get();

        return view('works.index', compact('works'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ottengo l'id dell'utente corrente
        $userId = Auth::id();

        // Ottengo i progetti a cui lavora l'utente
        $projects = DB::table('projects')
        ->select('projects.id','projects.name')
        ->join('user_projects','user_projects.project_id','projects.id')
        ->join('users','users.id','user_projects.user_id')
        ->where('user_projects.user_id', $userId)
        ->get();

        return view('works.create', compact('projects'));
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
        Log::info($input);

        // Ottengo l'id dell'utente corrente
        $userId = Auth::id();
        Log::info($userId);

        $validatedData = $request->validate([  
            'project_id'    => 'required',      
            'description'   => 'required',
            'hour'          => 'required|numeric|max:8|min:1',
            'date'          => 'required',
        ]);

        $work = new Work();
        $work->user_id = $userId;
        $work->project_id = $input['project_id'];
        $work->description = $input['description'];
        $work->hour = $input['hour'];
        $work->date = $input['date'];
        $work->save();

        //Project::create($input);

        return redirect('/work');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function show(Work $work)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function edit(Work $work)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Work $work)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work $work)
    {
        //
    }
}
