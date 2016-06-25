<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Task;
use App\Models\Comment;

class SearchController extends Controller
{
    //

    public function show(Search $search){
        return view('search.show', ['search' => $search]);
    }

    // search the value of the input q => a task or a comment
    // return the view of the result in another page
    public function store(Request $request, Task $task, Comment $comment, $id)
    {
        $tasks = Task::SearchInAvailableProperty($request->input('search'), $id)->get();

        $comment = Comment::SearchInAvailableProperty($request->input('search'), $id)->get();

//        dd($comment);
        return view('search.show', ['tasks'=> $tasks,'comment'=>$comment]);
    }

}
