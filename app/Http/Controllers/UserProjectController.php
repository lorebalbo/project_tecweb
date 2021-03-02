<?php

namespace App\Http\Controllers;

use App\UserProject;
use App\User;
use App\Project;
use Illuminate\Http\Request;
use DB;
use Log;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        $project_id = $project->id;
        //LOG::info($project);
        /* Ottengo gli utenti associati al progetto */
        /*$users = User::join('user_projects','user_projects.user_id','users.id')
        ->join('projects','projects.id','user_projects.project_id')
        ->where('projects.id', $project_id)
        ->select('user_projects.*','users.id','users.color','users.is_admin','users.name','users.surname','users.email')
        ->get();*/

        $users = UserProject::join('users','users.id','user_projects.user_id')
        ->join('projects','projects.id','user_projects.project_id')
        ->where('projects.id', $project_id)
        ->select('user_projects.*','users.color','users.is_admin','users.name','users.surname','users.email')
        ->get();

        //LOG::info($users);

        return view('userProject.index', compact('users'), compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $users = User::where('is_admin','0')->get();

        LOG::info($project);

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
        $u_id = $input['user_id'];
        //Log::info($id);

        /**
         * Custom Validation
         * Controllo che non vengano inseriti records duplicati
         */
        $messages = ['user_id.unique' => 'L utente è già associato al progetto', ];

        Validator::make($request->all(), [
            'user_id' => [
                'required',
                Rule::unique('user_projects')->where(function ($query) use($id,$u_id) {
                    return $query->where('project_id', $id)
                    ->where('user_id', $u_id);
                }),
            ],
        ],
        $messages
        )->validate();

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
    public function destroy($id, $project)
    {
        //$id = $project['id'];
        Log::info($id);
   //     Log::info($user);

        $user_project = UserProject::
        where('id', $id)
        ->delete();
        return redirect("/admin/user_project/$project/index");

        //return redirect("/admin/user_project/$id/index");
    }
}
