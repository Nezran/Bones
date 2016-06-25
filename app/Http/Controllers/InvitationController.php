<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Models\Invitation;
use App\Models\Project;
use App\Models\ProjectsUser;
use App\Models\User;

class InvitationController extends Controller
{
    // Return the invitation view to the user connected
    public function show(Request $request, Project $project)
    {
        // Recover users in the current porject
        $usersInProject = $project->users()->select('users.id')->get()->toArray();

        // Recover all invitations for all users, except if the users refuse the invation
        $inviteUsers = $project->invitations()->select('invitations.guest_id')->whereNotIn('status', ['refuse'])->get()->toArray();

        $usersDontNeed = [];

        foreach ($usersInProject as $user){
             array_push($usersDontNeed,$user['id']);
        }
        foreach ($inviteUsers as $guestId){
            if(!in_array($guestId['guest_id'], $usersDontNeed)){
                array_push($usersDontNeed, $guestId['guest_id']);
            }
        }
        $users = User::whereNotIn('users.id', $usersDontNeed)->select('users.id', 'avatar', 'mail', 'firstname', 'lastname')->join('roles', 'users.role_id', '=', 'roles.id')->where('roles.name', '!=', 'Prof')->get();
        return view('invitation.show', ['project' => $project, 'users' => $users]);
    }

    // Create an invitation
    public function store(Request $request, Project $project)
   {
       if($request->input('user')) {
           foreach ($request->input('user') as $key => $value) {
               $invitation = new Invitation;
               $invitation->guest_id = $key;
               $invitation->host_id = Auth::user()->id;
               $invitation->project_id = $project->id;
               $invitation->status = "Wait";
               $invitation->save();
           }
       }

       return redirect('project/' . $project->id);

    }

    // Return the view about the waiting invitations
    public function wait($id)
    {
        $wait = Invitation::where('project_id', '=', $id)->get();
        return view('invitation.wait', ['wait' => $wait]);
    }

    // Return the edition view
    public function edit()
    {
        $invitations = Invitation::where("guest_id", "=", Auth::user()->id)->get();
        return view('invitation.edit', ['invitations' => $invitations]);
    }

    // Accept a invitation
    public function accept(Invitation $invitation)
    {
        // Change the status in "Accept"
        $invitation->update([
            'status' => 'Accept'
        ]);

        (new EventController())->store($invitation->project_id, " accepter l'invitation"); // Create an event

        // Add the user in the project
        $liaison = new ProjectsUser();
        $liaison->project_id = $invitation->project_id;
        $liaison->user_id = Auth::user()->id;
        $liaison->save();
    }

    // Refuse a invitation
    public function refuse(Invitation $invitation)
    {
        // Change the status in "Refuse"
        $invitation->update([
            'status' => 'Refuse'
        ]);

        (new EventController())->store($invitation->project_id, " refuser l'invitation"); // Create an event
    }
}
