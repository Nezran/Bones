<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $table = 'events';
    protected $fillable = ['id', 'user_id','description', 'project_id', 'created_at'];

    public function project()
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }


}
