<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $fillable = ['name','level_id','state_id','visibility','description','project_id'];

    public function level()
    {
        return $this->belongsTo('App\Level');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}

