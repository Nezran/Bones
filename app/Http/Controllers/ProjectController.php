<?php

namespace App\Http\Controllers;

use App\Models\ProjectsUser;
use Illuminate\Http\Request;
use App\Models\UsersTask;
use App\Models\Project;
use App\Models\Comment;
use App\Models\User;
use App\Models\Task;
use App\Models\Event;
use App\Http\Requests;
use App\Http\Middleware\ProjectControl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Form;
use Datetime;
use App\Models\Target;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('ProjectControl', ['except' => [
            'index', 'create', 'store', 'valideTarget'
        ]]);
    }


    public function index()
    {
        // If the user has a role like "Eleve", he can access student view and he only can see his projects
        if (Auth::user()->role->name == "Eleve") {

            $projects = Auth::user()->projects()->get();

            return view('student', ['projects' => $projects]);

        }
        // If the user has a role like "Prof", he can access teacher view ans he can see all projects
        elseif(Auth::user()->role->name == "Prof"){

            $projects = Project::all();

            return view('teacher', ['projects' => $projects]);
        }
    }

    // Display all informations like the user's tasks connected, all project tasks, and so on
    public function show(Request $request)
    {
        $project = Project::find($request->id);
        $userTasks = UsersTask::where("user_id", "=", Auth::user()->id)->get();
        $duration = null;
        $task = null;
        foreach ($userTasks as $userstask) {
            foreach ($userstask->durationsTasks()->get() as $durationtask) {
                if ($durationtask->ended_at == null) {
                    $duration = $durationtask->id;
                    $task = $userstask->task_id;
                }
            }
        }

        return view('project/show', ['project' => $project, 'request' => $request, 'duration' => $duration, 'taskactive' => $task]);
    }

    // Return the view about files -> not yet made
    public function files()
    {
        return view('project/show');
    }

    // Return the view to editing projects
    public function edit()
    {
        return view('project/edit');
    }

    // Return the view about tasks
    public function task()
    {
        return view('project/task');
    }

    // Return the view to creating projects
    public function create()
    {
        return view('project/edition/create');
    }

    // Create a task
    public function store(Request $request)
    {
        $newProject = new Project;
        $relation = new ProjectsUser;
        $newProject->name = $request->input('name');
        $newProject->description = $request->input('description');
        $newProject->startDate = $request->input('date');
        $newProject->save();

        $relation->project_id = $newProject->id;
        $relation->user_id = Auth::user()->id;
        $relation->save();

        return redirect()->route('project.index');
    }

    // Return te view to creating tasks
    public function createTask($id)
    {
        return view('task.create', ['project' => $id]);
    }

    // Edit a task
    public function storeTask(Request $request)
    {
        $newTask = new Task;
        $newTask->name = $request->input('name');
        $newTask->duration = $request->input('duration');
        $newTask->date_jalon = $request->input('date_jalon');
        $newTask->project_id = $request->input('project_id');
        $newTask->parent_id = NULL;
        $newTask->save();

        (new EventController())->store($request->input('project_id'), "Créer une tâche parent"); // Create an event

        return redirect("project/" . $request->input('project_id'));
    }

    // Delete one or more users for a project
    public function destroyUser(Request $request){
        $destroyUser = ProjectsUser::where("project_id", "=", $request->id)->where("user_id", "=", $request->user)->get();
        $destroyUser->delete();
    }

    // Create a target
    public function storeTarget(Request $request, $id){

        $target = new Target;
        $target->description = $request->input('description');
        $target->project_id = $id;
        $target->status = "Wait";
        $target->save();

        return redirect("project/" . $id);
    }

   // Validate a target
    public function valideTarget(Request $request, Target $target){

        $target->update([
            'status' => "Finished"
        ]);

    }

    // Return the target view
    public function getTarget(Request $request, $id){
        return view('target.store', ['project' => $id]);
    }




    /*public function getTask(Request $request){

        if($request->ajax())
        {
            return 'getRequest has loaded comple';
        }

        $task = Task::find($request['task']);
        return view('project/taskdetail', ['task' => $task]);

        if(Request::ajax()){
            return Response::json(Request::all());
        }
    }*/

}