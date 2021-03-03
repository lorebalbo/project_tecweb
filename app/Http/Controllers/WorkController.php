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
use Carbon\Carbon;
use Redirect;


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

        $dateS = new Carbon('first day of this month');
        $dateE = new Carbon('last day of this month');
        LOG::info($userId);
        /* Ottengo i le attività dell'utente corrente */
        $works = Work::join('users','users.id','works.user_id')
        ->join('projects','projects.id','works.project_id')
        ->where('works.user_id', $userId)
        ->whereBetween('works.date', [$dateS, $dateE])
        ->select('works.*','projects.name')
        ->orderBy('date', 'desc')
        ->get();

        LOG::info($works);

        return view('works.index', compact('works'));
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

        /* Controllo che non vengano inseriti records duplicati */
        $messages = ['project_id.unique' => 'Per la data indicata è già stato inserito il progetto', ];

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

        /* Controllo che in un gioro una persona non inserisca attività la cui somma delle ore è maggiore di 24 ore */
        // Ottengo le ore che voglio inserire
        $hour = $request->hour;
        // Cerco nel DB le ore che ho già lavorato nella stessa data
        $hours_day = Work::select(DB::raw('SUM(works.hour) as ore'))
                        ->where('user_id', $u_id)
                        ->where('date',$dt) 
                        ->first()->ore;

        $hours_day_tot = $hours_day + $hour;

        if($hours_day_tot > 24){
            return Redirect::back()->withErrors("hai già lavorato $hours_day ore il $dt, non puoi inserire altre $hour ore");
        }

        /* Controllo che la data sia superiore a quella di inizio del progetto (start_date) */
        $start_date_check = Project::where('id',$p_id)->first()->start_date;
        //LOG::info($start_date_check);
        if($start_date_check > $dt){
            return Redirect::back()->withErrors("la data inserita è precedente alla data di inizio del progetto");
        }  

        /* Validazione campi form */
        $validatedData = $request->validate([  
            'project_id'    => 'required',      
            'description'   => 'required',
            'hour'          => 'required|numeric|max:24|min:1',
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
        $project = Project::where('id',$work->project_id)->get();
        
        return view('works.edit', compact('work'), compact('project'));
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
        LOG::info($input);
        //LOG::info($work);

        /*  
         * Salvo lo user_id, project_id e data del 
         * record che voglio inserire nel database
         */ 
        $p_id = $request->project_id;
        $u_id = Auth::id();
        $dt = $request->date;

        /* Controllo che in un gioro una persona non inserisca attività la cui somma delle ore è maggiore di 24 ore */
        // Ottengo le ore che voglio inserire
        $hour = $request->hour;
        // Cerco nel DB le ore che ho già lavorato nella stessa data
        $hours_day = Work::select(DB::raw('SUM(works.hour) as ore'))
                        ->where('user_id', $u_id)
                        ->where('date',$dt) 
                        ->first()->ore;

        // Cerco nel DB le ore che voglio modificare
        $hours_before = Work::where('user_id', $u_id)
                        ->where('date',$dt) 
                        ->where('project_id',$p_id) 
                        ->first()->hour;

        $hours_day_tot = $hours_day + $hour - $hours_before;

        if($hours_day_tot > 24){
            return Redirect::back()->withErrors("hai già lavorato $hours_day ore il $dt, non puoi inserire altre $hour ore");
        }

        $validatedData = $request->validate([  
            'project_id'    => 'required',      
            'description'   => 'required',
            'hour'          => 'required|numeric|max:24|min:1',
            'date'          => 'required',
        ]);

        $work->user_id = $input['user_id'];
        $work->project_id = $input['project_id'];
        $work->description = $input['description'];
        $work->hour = $input['hour'];
        $work->date = $input['date'];
        $work->save();

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

        if($fine == NULL || $inizio == NULL){
            return Redirect::back()->withErrors('Nessuna data inserita');
        }

        $works = Work::join('users','users.id','works.user_id')
        ->join('projects','projects.id','works.project_id')
        ->where('works.user_id', $userId)
        ->where('works.date', "<=", $fine)
        ->where('works.date', ">=", $inizio)
        ->select('works.*','projects.name')
        ->orderBy('date', 'desc')
        ->get();

        return view('works.search', compact('works'), compact('request'));
    }  
}
