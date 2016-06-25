<table class="table">
    <tr>
        <div class="panel-body">
            <th>Inviteur</th>
            <th>Invité</th>
            <th>Statut</th>
            <th>Date d'envoi</th>
        </div>
    </tr>
    @foreach($wait as $invit)
        <tr>
            <div class="panel-body">
                <td><p>{{$invit->host->firstname}} {{$invit->host->lastname}}</p></td>
                <td><p>{{$invit->guest->firstname}} {{$invit->guest->lastname}}</p></td>
                <td><p>{{$invit->status}}</p></td>
                <td><p>{{$invit->created_at}}</p></td>
            </div>
        </tr>
    @endforeach
</table>