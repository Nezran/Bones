<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    /**
     * Generated
     */

    protected $table = 'tasks';
    protected $fillable = ['id', 'name', 'duration', 'date_jalon', 'status', 'priority', 'project_id', 'parent_id', 'created_at'];


    public function project()
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id', 'id');
    }

    public function getUser(){
        return $this->hasManyThrough('App\Models\User','App\Models\UsersTask', 'task_id','id');
    }

    public function usersTasks()
    {
        return $this->hasMany(\App\Models\UsersTask::class, 'task_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(\App\Models\Task::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(\App\Models\Task::class, 'parent_id');
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    public function getElapsedDuration()
    {
        $total = 0;
        foreach ($this->usersTasks as $usertask) {
            foreach ($usertask->durationsTasks as $durationTask) {
                if ($durationTask->ended_at) {
                    $total += strtotime($durationTask->ended_at) - strtotime($durationTask->created_at);
                }
            }
        }

        foreach ($this->children as $child) {
            $total += $child->getElapsedDuration();
        }

        return $total;
    }


    public function getDurationTask(){

        $total = 0;

        $total += $this->duration;

        foreach ($this->children as $child){
            $total += $child->getDurationTask();
        }

        return $total;
    }

    public function ifChildTaskNoValidate($isFirst = true){
        if(!$isFirst && $this->status != "validate") return false;
        $children_activated = true;
        foreach ($this->children as $child) {
            if (!$child->ifChildTaskNoValidate(false)) {
                $children_activated = false;
            }
        }
        return $children_activated;
    }


    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class, 'task_id');
    }

    // he task if like the entry of the input q with a value before or after
    // do a second where, to do the search for the project and not another
    public static function scopeSearchInAvailableProperty($query, $q, $id)
    {
        return $query->where('name', 'like', "%{$q}%")->where('project_id', '=', "{$id}");
    }
}
