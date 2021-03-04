<?php

namespace App\Http\Controllers;

use App\Project;
use App\Client;
use App\Work;
use App\User;
use Illuminate\Http\Request;
use Log;
use Redirect;
use App\UserProject;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();

        return view('projects.create', compact('clients'));
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

        $validatedData = $request->validate([  
            'client_id'             => 'required',      
            'name'                  => 'required',
            'description'           => 'required|string|max:144',
            'start_date'            => 'required',
            'expected_end_date'     => 'required|after:start_date',
            'cost_pr_hour'          => 'required',            
        ]);

        $project = new Project();
        $project->name = $input['name'];
        $project->description = $input['description'];
        $project->start_date = $input['start_date'];
        $project->expected_end_date = $input['expected_end_date'];
        //$project->effective_end_date = $input['effective_end_date'];
        $project->cost_pr_hour = $input['cost_pr_hour'];
        $project->note = $input['note'];
        $project->client_id = $input['client_id'];
        $project->save();

        //Project::create($input);

        return redirect('/admin/project');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        LOG::info($project);

        
        //$project->expected_end_date = $request->filled('effective_end_date') ? date('Y-m-d H:i:s', strtotime($request->input('effective_end_date'))) : NULL;
        return view('projects.show', compact('project'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //Log::info($project);
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $input = $request->all();

        $validatedData = $request->validate([  
                 
            'name'                  => 'required',
            'description'           => 'required|string|max:144',
            'start_date'            => 'required',
            'expected_end_date'     => 'required|after:start_date',
            'cost_pr_hour'          => 'required|numeric',
        ]);

        /* Controllo data fine effettiva, se viene inserita*/
        if($request->effective_end_date > 0){
            $request->validate([ 'effective_end_date'    => 'sometimes|after:start_date', ]);
            
            $query = Work::join('projects','projects.id','works.project_id')->where('projects.name',$request->name)
            
                        ->where('date','>',$request->effective_end_date)
                        ->get();
            //LOG::info($query);
            
            if($query->isNotEmpty()){
                return Redirect::back()->withErrors("Data Fine Effettiva, ci sono attività svolte dopo il $request->effective_end_date");
            }
        }

        $project->name = $input['name'];
        $project->description = $input['description'];
        $project->start_date = $input['start_date'];
        $project->expected_end_date = $input['expected_end_date'];
        $project->effective_end_date = $input['effective_end_date'];
        $project->cost_pr_hour = $input['cost_pr_hour'];
        $project->note = $input['note'];
        $project->save();

        return redirect('/admin/project');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        /* Controllo che il progetto non sia associato ad utenti o ad attività */
        $associazioni = UserProject::where('project_id',$project->id)->get(); 
        $attivita = Work::where('project_id',$project->id)->get(); 
        
        if($associazioni->isNotEmpty() || $attivita->isNotEmpty()){
            LOG::info($associazioni);
            return view('projects.edit', compact('project'))->withErrors("il progetto è associato ad utenti o attività");
        }

        $project->delete();
        
        return redirect('/admin/project');
    }
}
