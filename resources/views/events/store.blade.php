<form class="form-horizontal" role="form" method="POST" action="{{route('project.storeEvents',$id)}}">
    {!! csrf_field() !!}

    <div class="form-group">
        <label class="col-md-4 control-label">Description de l'événement</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="description" value="" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-sign-in"></i>Sauvegarder
            </button>
        </div>
    </div>
</form>