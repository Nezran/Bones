<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersTask extends Model {

    /**
     * Generated
     */

    public $timestamps = false;
    protected $table = 'users_tasks';
    protected $fillable = ['id', 'user_id', 'task_id'];


    public function task() {
        return $this->belongsTo(\App\Models\Task::class, 'task_id', 'id');
}

    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function durationsTasks() {
        return $this->hasMany(\App\Models\DurationsTask::class, 'user_task_id', 'id');
    }




}
