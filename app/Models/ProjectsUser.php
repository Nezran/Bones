<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectsUser extends Model {

    /**
     * Generated
     */

    protected $table = 'projects_users';
    protected $fillable = ['project_id', 'user_id'];


    public function project() {
        return $this->belongsTo(\App\Models\Project::class, 'project_id', 'id');
    }

    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }


}
