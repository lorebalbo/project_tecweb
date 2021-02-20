<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'contact_name',
        'contact_surname',
        'contact_email',
        'business_name',
    ];

    public function projects()
    {
        return $this->hasMany('App\Projects');
    }
}
