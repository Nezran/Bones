@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><h3>{{$user->id}} - {{$user->fullname}}</h3></div><!-- Display user fullname -->
            <div class="panel-body">
                <img style="width: 80px; border-radius : 50%;" src="../avatar/{{$user->avatar}}" \>
                <form enctype="multipart/form-data" action="{{route('user.avatar',Auth::user()->id)}}" method="post">
                    {!! csrf_field() !!}

                    <div class="panel-heading">
                    Votre Avatar</div>
                    <input type="file" name="avatar">
                    <input type="submit" value="Envoyer">
                </form>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading"><h3>Informations</h3></div>
            <div class="panel-body">
                <!-- Display the email and the role -->
                <p>Email : {{$user->mail}}</p>
                <p>Votre rôle : @if($user->role_id == 1) Eleve @else Prof @endif</p>
            </div>
        </div>
@endsection