<?php

namespace App\Http\Controllers;

use App\Project;
use App\Client;
use Illuminate\Http\Request;
use Log;

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
/*
        $validatedData = $request->validate([  
            'client_id'             => 'required',      
            'name'                  => 'required',
            'description'           => 'required',
            'start_date'            => 'required',
            'expected_end_date'     => 'required',
            'effective_end_date'    => 'required',
            'cost_pr_hour'          => 'required',
            'note'                  => 'required',
            
        ]);*/

        $project = new Project();
        $project->name = $input['name'];
        $project->description = $input['description'];
        $project->start_date = $input['start_date'];
        $project->expected_end_date = $input['expected_end_date'];
        $project->effective_end_date = $input['effective_end_date'];
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        Log::info($project);
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
        $project->delete();

        return redirect('/admin/project');
    }
}
