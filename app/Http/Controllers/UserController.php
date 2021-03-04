<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserProject;
use App\Work;
use Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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

        $validatedData = $request->validate([        
            'is_admin'          => 'required',
            'name'              => 'required',
            'surname'           => 'required',
            'color'             => 'required',
            'email'             => 'required',
            'verified_email'    => 'required',
            'password'          => 'required',
        ]);
        
        User::create($input);

        return redirect('/admin/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $input = $request->all();

        $user->is_admin = $input['is_admin'];
        $user->name = $input['name'];
        $user->surname = $input['surname'];
        $user->color = $input['color'];
        $user->email = $input['email'];
        $user->save();

        return redirect('/admin/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        /* Controllo che l'utente non sia associato a progetti o ad attività */
        $associazioni = UserProject::where('user_id',$user->id)->get(); 
        $attivita = Work::where('user_id',$user->id)->get(); 
        
        if($associazioni->isNotEmpty() || $attivita->isNotEmpty()){
            LOG::info($associazioni);
            return view('users.edit', compact('user'))->withErrors("l'utente è associato a progetti o attività");
        }

        $user->delete();

        return redirect('/admin/user');
    }
}
