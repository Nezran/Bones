
<form class="form-horizontal" role="form" method="POST" action="{{ route('invitation.store', $project->id) }}">
    {!! csrf_field() !!}
        <div class="checkbox">
            @foreach($users as $user)
                    <!-- Display all users which aren't in the project and didn't invite -->
                    <label>
                        <input type="checkbox" name="user[{{$user->id}}]">
                        @include('user.avatar', ['user' => $user])
                    </label>
            @endforeach
        </div>
        <br>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-plus"></i>Ajouter un/des utilisateur(s)
                </button>
            </div>
        </div>
    </form>

</form>