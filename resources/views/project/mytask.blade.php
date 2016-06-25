<!-- Display all tasks about user connected -->
@foreach ($task->usersTasks as $usertask)
    <li>
        @if($usertask->user_id == Auth::user()->id)

            <a>
                <span class="taskshow" data-id="{{$task->id}}">
                    <p>{{$task->name}}</p>
                </span>

                <button class="right btn btn-lg
                @if($taskactive == null)
                        taskplay" data-usertaskid="{{$usertask->id}}"
                        @elseif($taskactive == $task->id)
                        taskstop
                " data-usertaskid="{{$usertask->id}}" data-duration="{{$duration}}"
                @else
                    taskplay" data-usertaskid="{{$usertask->id}}"
                @endif
                >
                <span class="glyphicon
                @if($taskactive == null)
                        glyphicon-play-circle
                @elseif($taskactive == $task->id)
                        glyphicon-stop
                @else()
                        glyphicon-play-circle
                @endif
                        " aria-hidden="true"></span>
                </button>
                <button class="right btn btn-lg validate" data-task="{{$usertask->task_id}}">
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                </button>
            </a>
            <div class="progression"
                 style="background: linear-gradient(90deg, #20DE13 {{(($task->getElapsedDuration()*100/60/60)/$task->duration)}}%, #efefef 0%);">
                <p style="text-align: left;">{{gmdate("H:i:s",$task->getElapsedDuration())}}</p>
                <p> | {{round(($task->getElapsedDuration()*100/60/60)/$task->duration,1)}}%</p>
                <p style="text-align: right;margin-left: auto;">{{$task->getDurationTask()}}h</p>
            </div>

        @endif

        @if($task->children->isEmpty())
    </li>
        @else
        <ul>
            @foreach($task->children as $task)
                @include('project.mytask', ['taskactive' => $taskactive, 'duration' => $duration])
            @endforeach
        </ul>
        @endif
    </li>

@endforeach