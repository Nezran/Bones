<table class="table">
    <tr>
        <th>Statut</th>
        <th>Invité</th>
        <th>Hôte</th>
        <th>Projet</th>
        <th>Créer le</th>
        <th>Action</th>
    </tr>

    @foreach($invitations as $invitation)

        <tr>
            <td>{{$invitation->status}}</td>
            <td>{{$invitation->guest->fullName}}</td>
            <td>{{$invitation->host->fullname}}</td>
            <td>{{$invitation->project->name}}</td>
            <td>{{$invitation->created_at}}</td>

            <!-- If the invation has a status "Wait", display the buttons to accept or refuse the invation -->
            @if($invitation->status == 'Wait')
                <td>
                    <button style="float: left;padding: 3px 6px;" class="left btn invitationaccept" data-invitation="{{$invitation->id}}"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> </button>
                    <button style="float: left;padding: 3px 6px;" class="left btn invitationrefuse" data-invitation="{{$invitation->id}}"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </button>
                </td>
            @else

                <td></td>

            @endif

        </tr>

    @endforeach

</table>