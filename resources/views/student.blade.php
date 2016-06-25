@extends('layouts.app')

@section('content')
    <div class="container">

            <!-- Display all projects for the user connected -->
            @foreach($projects as $project)

            <div class="panel panel-default">
                <div class="panel-heading"><h2><a href="{{route('project.index')}}/{{ $project->id }}">{{ $project->name }}</a></h2></div><!-- Display the project name -->
                <div class="panel-body">
                    <h4>Membres : </h4>
                    <!-- Display all project members -->
                    @foreach($project->users as $user)
                        @include('user.avatar', ['user' => $user])
                    @endforeach
                </div>
            </div>
            @endforeach
        <a class="button btn btn-default" href="{{route('project.create')}}">Créer votre projet !</a>
    </div>
@endsection
