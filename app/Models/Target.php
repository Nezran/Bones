<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    //
    protected $table = 'targets';
    protected $fillable = ['id','description', 'project_id', 'created_at', 'status'];

    public function project()
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id', 'id');
    }


}
