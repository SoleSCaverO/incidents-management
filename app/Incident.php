<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $table = 'incidents';
    protected $fillable = ['name','summary','category','state_id','date','frequency_id','priority_id','user_id',
                           'file','visibility_id','platform','os','os_version','low','project_id'];

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function frequency()
    {
        return $this->belongsTo('App\Frequency');
    }

    public function priority()
    {
        return $this->belongsTo('App\Priority');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function visibility()
    {
        return $this->belongsTo('App\Visibility');
    }
}
