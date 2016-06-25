<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['id', 'comment', 'user_id', 'task_id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function task()
    {
        return $this->belongsTo(\App\Models\Task::class, 'task_id', 'id');
    }

    public static function scopeSearchInAvailableProperty($query, $q, $id)
    {
        return $query->join('tasks', 'tasks.id', '=', 'comments.task_id')
            ->join('projects', 'projects.id', '=','tasks.project_id')
            ->where('comment', 'like', "%{$q}%")
            ->where('tasks.project_id', '=', $id);
    }

}
