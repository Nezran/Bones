<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\ProjectsUser;
use App\Models\UsersTask;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;
use App\Models\Event;
use App\Http\Middleware\ProjectControl;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // Display all project events
    public function show(Project $project, Request $request)
    {
        $events = Project::find($request->id)->events;

        return $events->toJson();// Return the events as a json array
    }

    // Create an event
    public function store($project, $desc)
    {
        $event = new Event;
        $event->user_id = Auth::user()->id;
        $event->project_id = $project;
        $event->description = $desc;
        $event->save();
    }

    // Return view event form
    public function formEvent($id)
    {
        return view('events.store', ['id' => $id]);
    }
}
