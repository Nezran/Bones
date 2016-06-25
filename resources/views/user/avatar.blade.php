<div class="well well-sm" style="max-width: 250px;">
    <div class="media">
        <div class="media-left media-middle">
        	<!-- Display the user avatar -->
            <img style="border: 1px solid #444141;width: 40px; border-radius : 50%; float: left;" src="{{URL::asset('/avatar/'.$user->avatar)}}" \>
        </div>
        <div class="media-body">
        	<!-- Display the fullname and the email -->
            <h4 class="media-heading">{{$user->fullname}}</h4>
            <p>{{$user->mail}}</p>
        </div>
    </div>
</div>