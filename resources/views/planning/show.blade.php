

<script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js" ></script >
  <script type = "text/javascript" >
        google . charts . load('current', {'packages':['gantt']});
    google . charts . setOnLoadCallback(drawChart);

    function drawChart()
    {

        var
        data = new google . visualization . DataTable();
        data . addColumn('string', 'Task ID');
        data . addColumn('string', 'Task Name');
        data . addColumn('date', 'Start Date');
        data . addColumn('date', 'End Date');
        data . addColumn('number', 'Duration');
        data . addColumn('number', 'Percent Complete');
        data . addColumn('string', 'Dependencies');

        data . addRows([
                @foreach($taskparent as $task)


                ['{{$task->id}}', '{{$task->name}}',
                        new Date({{$task->created_at->year}},{{$task->created_at->month}},{{$task->created_at->day}},{{$task->created_at->hour}},{{$task->created_at->minute}}), new Date({{date("Y",strtotime($task->date_jalon))}}, {{date("m",strtotime($task->date_jalon))}}, {{date("d",strtotime($task->date_jalon))}},10), {{$task->duration/24}}, {{round(($task->getElapsedDuration()*100/60/60)/$task->duration,1)}}, null],

                @endforeach
        ]);

        var
        options = {
        height:
        400,
        gantt: {
            trackHeight:
            30
        }
      };

      var chart = new google . visualization . Gantt(document . getElementById('chart_div'));

      chart . draw(data, options);
    }
  </script >

  <div id = "chart_div" ></div >