<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\UsersTask;

class DurationsTask extends Model
{

    /**
     * Generated
     */

    protected $table = 'durations_tasks';
    protected $fillable = ['id', 'created_at', 'ended_at', 'user_task_id'];


    public function usersTask()
    {
        return $this->belongsTo(\App\Models\UsersTask::class, 'user_task_id', 'id');
    }

    public function scopeActive($query, $user, $id)
    {
        $userTasks = UsersTask::where("user_id", "=", $id)->get();
        foreach ($userTasks as $userstask) {
            // $userstask->durationsTasks();
            //dd($userstask->durationsTasks()->get());
            foreach ($userstask->durationsTasks()->get() as $durationtask) {
                if ($durationtask->ended_at == null) {
                    return false;
                }
            }

        }
        $newActiveTask = new DurationsTask;
        $newActiveTask->user_task_id = $query->model->user_task_id;
        $newActiveTask->save();
        return $newActiveTask->id;
    }
}
