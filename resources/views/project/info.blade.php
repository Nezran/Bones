<div class="panel panel-default">
    <div class="panel-heading">Informations</div>

    <div class="panel-body">
        <!-- Display the information about project -->
        <p>Nom : {{$project->name}}</p>
        <p>Date de début : {{$project->startDate}}</p>
        <p>Description : {{$project->description}}</p>
    </div>

    <div class="panel-heading">Membres du projet</div>

    <div class="panel-body">
        @foreach($project->users as $user)
            <p>
                <!-- Display all project members -->
                @include('user.avatar', ['user' => $user])
                <button class="right btn userprojectdestroy" data-id="{{$user->id}}" data-projectid="{{$project->id}}">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            </p>
        @endforeach
        <a class="btn btn-warning invitation" data-projectid="{{$project->id}}">Ajouter une personne</a>
        <a class="btn btn-warning invitationwait" data-projectid="{{$project->id}}">Voir les invitations en attente</a>

    </div>

    <div class="panel-heading">Objectifs du projet</div>

    <div class="panel-body">
        <!-- Display all project objectives -->
        <ol class="targets">
        @foreach($project->targets as $target)
            <li class="@if($target->status == 'Finished'){{'finished'}}@endif">{{$target->description}}
                @if($target->status == 'Wait')
                <button class="right btn validetarget" data-targetid="{{$target->id}}">
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                </button>
                @endif
            </li>
        @endforeach
        </ol>
        <br>
        <a class="btn btn-warning target" data-projectid="{{$project->id}}">Ajouter un objectif</a>
    </div>


</div>

