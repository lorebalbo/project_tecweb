<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'expected_end_date',
        'effective_end_date',
        'cost_pr_hour',
        'note'
    ];

    

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function userProject()
    {
        return $this->hasMany('App\UserProject');
    }
}


