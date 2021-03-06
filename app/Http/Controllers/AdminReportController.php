<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Work;
use App\Project;
use App\UserProject;
use App\User;
use Log;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Redirect;


class AdminReportController extends Controller
{
    /* Visualizzo il totale delle ore per ogni PROGETTO nel MESE CORRENTE */
    public function project_hours(){

        $dateS = new Carbon('first day of this month');
        $dateE = new Carbon('last day of this month');
        //LOG::info($dateS);

        $project_hours = DB::table('works')
        ->select('projects.name', DB::raw('SUM(works.hour) as ore'))
        ->join('users','users.id','works.user_id')
        ->join('projects','projects.id','works.project_id')
        ->whereBetween('works.date', [$dateS, $dateE])
        ->groupBy('projects.name')
        ->get();

        //LOG::info($project_hours);

        return view('adminReports.project_hours', compact('project_hours'));
    }

    /* Visualizzo il totale delle ore per ogni PROGETTO nel RANGE DI DATE selezionato */
    public function search_project_hours(Request $request){

        $dateS = $request->get('from_date');
        $dateE = $request->get('to_date');
        //LOG::info($dateS);
        //LOG::info($dateE);

        /* Controllo che siano state inserite delle date*/
        if($dateE == NULL || $dateS == NULL){
            return Redirect::back()->withErrors('Nessuna data inserita');
        }

        /* Controllo che la data "DA" sia minore della data "A" */
        if($dateS > $dateE){
            return Redirect::back()->withErrors('La data di inizio deve essere minore di quella di fine');
        }

        $project_hours = DB::table('works')
        ->select('projects.name', DB::raw('SUM(works.hour) as ore'))
        ->join('users','users.id','works.user_id')
        ->join('projects','projects.id','works.project_id')
        ->whereBetween('works.date', [$dateS, $dateE])
        ->groupBy('projects.name')
        ->get();

        LOG::info($project_hours);

        /* Messaggio in caso non venga trovato nessun risultato */
        if($project_hours->isEmpty()){
            return view('adminReports.search_project_hours', compact('project_hours'), compact('request'))->with('msg','Nessun record da visualizzare tra queste date');
        }  

        return view('adminReports.search_project_hours', compact('project_hours'), compact('request'));
    }

    /* Visualizzo il totale delle ore per ogni CLIENTE nel MESE CORRENTE */
    public function client_hours(){

        $dateS = new Carbon('first day of this month');
        $dateE = new Carbon('last day of this month');

        $client_hours = DB::table('projects')
        ->select('clients.business_name', DB::raw('SUM(works.hour) as ore'))
        ->join('works','works.project_id','projects.id')
        ->join('clients','clients.id','projects.client_id')
        ->whereBetween('works.date', [$dateS, $dateE])
        ->groupBy('clients.business_name')
        ->get();

        //LOG::info($client_hours);

        return view('adminReports.client_hours', compact('client_hours'));
    }

    /* Visualizzo il totale delle ore per ogni CLEINTE nel RANGE DI DATE selezionato */
    public function search_client_hours(Request $request){

        $dateS = $request->get('from_date');
        $dateE = $request->get('to_date');
        //LOG::info($dateS);
        //LOG::info($dateE);

        /* Controllo che siano state inserite delle date*/
        if($dateE == NULL || $dateS == NULL){
            return Redirect::back()->withErrors('Nessuna data inserita');
        }

        /* Controllo che la data "DA" sia minore della data "A" */
        if($dateS > $dateE){
            return Redirect::back()->withErrors('La data di inizio deve essere minore di quella di fine');
        }

        $client_hours = DB::table('projects')
        ->select('clients.business_name', DB::raw('SUM(works.hour) as ore'))
        ->join('works','works.project_id','projects.id')
        ->join('clients','clients.id','projects.client_id')
        ->whereBetween('works.date', [$dateS, $dateE])
        ->groupBy('clients.business_name')
        ->get();

        /* Messaggio in caso non venga trovato nessun risultato */
        if($client_hours->isEmpty()){
            return view('adminReports.search_client_hours', compact('client_hours'), compact('request'))->with('msg','Nessun record da visualizzare tra queste date');
        }  

        //LOG::info($client_hours);

        return view('adminReports.search_client_hours', compact('client_hours'), compact('request'));
    }
}
