@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Votre recherche de commentaires</div>
            <div class="panel-body">
                <table class="table">

                    @if(!$comment->isEmpty())
                        <tr>
                            <th>commentaire</th>
                            <th>Créé le</th>
                            <th>Nom de l'utilisateur</th>
                        </tr>
                        @foreach($comment as $comment)
                            <tr>
                                <td>{{$comment->comment}}</td>
                                <td>{{$comment->created_at}}</td>
                                <td>{{$comment->user->fullName}}</td>
                            </tr>
                        @endforeach
                    @else
                        <h1>Aucun résultat</h1>
                    @endif
                </table>
            </div>

            <div class="panel-heading">Votre recherche de tâches</div>
            <div class="panel-body">
                <table class="table">

                    @if(!$tasks->isEmpty())
                        <tr>
                            <th>id</th>
                            <th>Nom de la tâche</th>
                            <th>Créé le</th>
                            <th>Mis à jour le</th>
                            <th>Date du jalon</th>
                            <th>durée</th>
                            <th>Membres</th>
                        </tr>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{$task->id}}</td>
                                <td>{{$task->name}}</td>
                                <td>{{$task->created_at}}</td>
                                <td>{{$task->updated_at}}</td>
                                <td>{{$task->date_jalon}}</td>
                                <td>{{$task->duration}}</td>
                                <td>
                                    @foreach($task->usersTasks()->get() as $usertask)
                                        <p>
                                            <!-- Display all project members -->
                                            @include('user.avatar', ['user' => $usertask->user()->get()[0]])
                                        </p>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <h1>Aucun résultat</h1>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection



