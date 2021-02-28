<?php

namespace App\Http\Controllers;

use App\UserProject;
use App\User;
use App\Project;
use Illuminate\Http\Request;
use DB;
use Log;
use Redirect;

class UserProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        //$usersproject = UserProject::all();
        //Log::info($usersproject);
        
        //Log::info($project);

        //$users = User::all();

        //Log::info($users);

        $project_id = $project->id;

        //Log::info($project_id);

        $users = DB::table('users')
        ->select('users.color','users.is_admin','users.name','users.surname','users.email')
        ->join('user_projects','user_projects.user_id','users.id')
        ->join('projects','projects.id','user_projects.project_id')
        //->where('users.name','Giovanni')
        ->where('projects.id', $project_id)
        ->get();

        return view('userProject.index', compact('users'), compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $users = User::all();

        return view('userProject.create', compact('users'), compact('project'));
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

        $id = $input['project_id'];
        //Log::info($id);

        $userproject = new UserProject();
        $userproject->user_id = $input['user_id'];
        $userproject->project_id = $input['project_id'];
        $userproject->save();

        return redirect("/admin/user_project/$id/index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserProject  $userProject
     * @return \Illuminate\Http\Response
     */
    public function show(UserProject $userProject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserProject  $userProject
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, User $user)
    {
        Log::info($project);
        Log::info($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserProject  $userProject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserProject $userProject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserProject  $userProject
     * @return \Illuminate\Http\Response
     */
    public function destroy($project)
    {
        //$id = $project['id'];
        Log::info($project);
        //Log::info($user);


        //return redirect("/admin/user_project/$id/index");
    }
}
