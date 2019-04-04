<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $fillable = ['message', 'workshop_id','user_id','status'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function workshop()
    {
        return $this->belongsTo('App\Workshop');
    }
}
