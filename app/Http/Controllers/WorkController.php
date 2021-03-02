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
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Ottengo l'id dell'utente corrente */
        $userId = Auth::id();

        /*
        $works = DB::table('works')
        ->select('works.id','works.project_id','projects.name','works.user_id','works.description','works.hour','works.date')
        ->join('users','users.id','works.user_id')
        ->join('projects','projects.id','works.project_id')
        ->where('works.user_id', $userId)
        ->get();

        /* Ottengo i le attività dell'utente corrente */
        $works = Work::join('users','users.id','works.user_id')
        ->join('projects','projects.id','works.project_id')
        ->where('works.user_id', $userId)
        ->select('works.*','projects.name')
        ->orderBy('date', 'desc')
        ->get();

        LOG::info($works);

        return view('works.index', compact('works'));

        //return view('works.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* Ottengo l'id dell'utente corrente */
        $userId = Auth::id();

        /* Ottengo i progetti a cui lavora l'utente */
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

        /*  
         * Salvo lo user_id, project_id e data del 
         * record che voglio inserire nel database
         */ 
        $p_id = $request->project_id;
        $u_id = Auth::id();
        $dt = $request->date;

        /**
         * Custom Validation
         * Controllo che non vengano inseriti records duplicati
         */
        $messages = ['project_id.unique' => 'Un record simile esiste già, controlla nell elenco delle attività', ];

        Validator::make($request->all(), [
            'project_id' => [
                'required',
                Rule::unique('works')->where(function ($query) use($p_id,$u_id,$dt) {
                    return $query->where('project_id', $p_id)
                    ->where('user_id', $u_id)
                    ->where('date',$dt);
                }),
            ],
        ],
        $messages
        )->validate();

        $validatedData = $request->validate([  
            'project_id'    => 'required',      
            'description'   => 'required',
            'hour'          => 'required|numeric|max:8|min:1',
            'date'          => 'required',
        ]);

        /*
         * Inserisco il record nel database
         */ 
        $work = new Work();
        $work->user_id = $u_id;
        $work->project_id = $input['project_id'];
        $work->description = $input['description'];
        $work->hour = $input['hour'];
        $work->date = $input['date'];
        $work->save();

        return redirect('/work');


        /*
        // Controllo se il record è già presente
        $works = Work::where('project_id',$p_id)
        ->where('user_id',$u_id)
        ->where('date',$dt)
        ->first();
        //Log::info($works);

        if($works === null){
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

            return redirect('/works');
        }
        else{
            dd('esiste');
        }
        */
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
        LOG::info($work);
        return view('works.edit', compact('work'));
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
        $input = $request->all();
        //LOG::info($input);
        //LOG::info($work);

        /*  
         * Salvo lo user_id, project_id e data del 
         * record che voglio inserire nel database
         */ 
        $p_id = $request->project_id;
        $u_id = Auth::id();
        $dt = $request->date;

        $validatedData = $request->validate([  
            'project_id'    => 'required',      
            'description'   => 'required',
            'hour'          => 'required|numeric|max:8|min:1',
            'date'          => 'required',
        ]);

        $work->user_id = $input['user_id'];
        $work->project_id = $input['project_id'];
        $work->description = $input['description'];
        $work->hour = $input['hour'];
        $work->date = $input['date'];
        $work->save();
/*
        $userId = Auth::id();
        $projectId = $request->get('project_id');
        $date = $request->get('date');

        $works = DB::table('works')
        ->select('works.project_id','works.user_id','works.description','works.hour','works.date')
        ->join('users','users.id','works.user_id')
        ->join('projects','projects.id','works.project_id')
        ->where('works.user_id', $userId)
        ->where('works.date', "<=", $date)
        ->where('works.project_id', $projectId)
        ->orderBy('date', 'asc')
        ->orderBy('projects.name', 'desc')
        ->get();

        LOG::info($works);
        */

        //$work->project_id = $input['name'];
        //$work->save();

        return redirect('/work');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work $work)
    {
        $work->delete();
        return redirect('/work');
    }

    public function search(Request $request)
    {
        // Ottengo l'id dell'utente corrente
        $userId = Auth::id();
        $inizio = $request->get('from_date');
        $fine = $request->get('to_date');

        Log::info($inizio);
        Log::info($fine);
/*
        $works = DB::table('works')
        ->select('projects.name','works.description','works.hour','works.date')
        ->join('users','users.id','works.user_id')
        ->join('projects','projects.id','works.project_id')
        ->where('works.user_id', $userId)
        ->where('works.date', "<=", $fine)
        ->where('works.date', ">=", $inizio)
        ->orderBy('date', 'asc')
        ->orderBy('projects.name', 'desc')
        ->get();*/

        $works = Work::join('users','users.id','works.user_id')
        ->join('projects','projects.id','works.project_id')
        ->where('works.user_id', $userId)
        ->where('works.date', "<=", $fine)
        ->where('works.date', ">=", $inizio)
        ->select('works.*','projects.name')
        ->orderBy('date', 'desc')
        ->get();

        return view('works.search', compact('works'));
    }  
}
