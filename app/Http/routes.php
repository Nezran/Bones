<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'web'], function () {

    Route::get('login', 'SessionController@create');
    Route::post('login', 'SessionController@store');
    
    Route::group(['middleware' => 'auth'], function(){

        /* TASK */
        Route::resource('tasks', 'TaskController',
            ['parameters' =>
                ['tasks' => 'task']
            ]
        );
        Route::get('tasks/{task}/',['as' => 'tasks.show','uses' => 'TaskController@show'])->where('task', '[0-9]+');
        Route::get('tasks/{task}/children/create', ['as' => 'tasks.createChildren','uses' => 'TaskController@createChildren'])->where('task', '[0-9]+');
        Route::post('tasks/{task}/children/', ['as' => 'tasks.storeChildren','uses' => 'TaskController@storeChildren'])->where('task', '[0-9]+');
        Route::post('tasks/{task}/play', ['as' => 'tasks.play', 'uses' => 'TaskController@play'])->where('task', '[0-9]+');
        Route::post('tasks/{task}/status', ['as' => 'tasks.status', 'uses' => 'TaskController@status'])->where('task', '[0-9]+');
        Route::get('tasks/{task}/users/', ['as' => 'tasks.users', 'uses' => 'TaskController@users'])->where('task', '[0-9]+');
        Route::post('tasks/{task}/users/', ['as' => 'tasks.storeUsers', 'uses' => 'TaskController@storeUsers'])->where('task', '[0-9]+');
        Route::delete('tasks/{usersTask}/users/', ['as' => 'tasks.userTaskDelete', 'uses' => 'TaskController@userTaskDelete'])->where('usersTask', '[0-9]+');
        Route::post('tasks/{durationsTask}/stop', ['as' => 'tasks.stop', 'uses' => 'TaskController@stop'])->where('durationsTask', '[0-9]+');
        Route::post('tasks/{task}', 'TaskController@store')->where('task', '[0-9]+');

        /* PROJECT */
        Route::resource('project','ProjectController',
            ['parameters' => ['project' => 'id']], 
            ['only' => ['index']]
        );
        Route::get('/', 'ProjectController@index');
        Route::get('project/{id}', ['as' => 'project.show', 'uses' => 'ProjectController@show' ])->where('id', '[0-9]+');
        Route::get('project/{id}/tasks/create', 'ProjectController@createTask')->where('id', '[0-9]+');
        Route::post('project/{id}/tasks', 'ProjectController@storeTask')->where('id', '[0-9]+');
        Route::get('project/{id}/files', 'ProjectController@files')->where('id', '[0-9]+');
        Route::delete('project/{id}/users/{user}/destroy', 'ProjectController@destroyUser')->where('id', '[0-9]+');
        Route::post('project/{id}/target', ['as' => 'project.storetarget', 'uses' => 'ProjectController@storeTarget'])->where('projectid', '[0-9]+');
        Route::post('target/{target}/valide', ['as' => 'project.validetarget', 'uses' => 'ProjectController@valideTarget'])->where('target', '[0-9]+');
        Route::get('project/{id}/target', ['as' => 'project.gettarget', 'uses' => 'ProjectController@getTarget'])->where('id', '[0-9]+');
        /* FILES */
        Route::post('project/{id}/file', ['as' => 'files.store', 'uses' => 'FileController@store']);
        //Route::get('project/{id}/file', ['as' => 'files.show', 'uses' => 'FileController@show']);
        Route::delete('project/{id}/file/{file}', ['as' => 'files.destroy', 'uses' => 'FileController@destroy']);

        Route::post('project/{id}/file', ['as' => 'files.store', 'uses' => 'FileController@store'])->where('id', '[0-9]+');

        /* APP */
        Route::get('logout', 'SessionController@destroy');

        /* INVITATION PROJECTS */
        Route::get('project/{project}/invitations/', 'InvitationController@show')->where('project', '[0-9]+');
        Route::get('project/{projectid}/invitations/wait', 'InvitationController@wait')->where('projectid', '[0-9]+');
        Route::post('project/{project}/invitations/', ['as' => 'invitation.store', 'uses' => 'InvitationController@store'])->where('project', '[0-9]+');
        Route::get('project/{projectid}/target', ['as' => 'project.events',  'uses' => 'InvitationController@target'])->where('projectid', '[0-9]+');
        Route::get('invitations','InvitationController@edit');
        Route::post('invitations/{invitation}/accept',['as'=> 'invitations.accept','uses'=>'InvitationController@accept'])->where('invitation', '[0-9]+');;
        Route::post('invitations/{invitation}/refuse',['as'=> 'invitations.refuse','uses'=>'InvitationController@refuse'])->where('invitation', '[0-9]+');;

        /* USER */
        Route::get('user/{user}', ['as'=> 'user.show','uses'=>'UserController@show'])->where('user', '[0-9]+');
        Route::post('user/{user}/avatar',['as'=> 'user.avatar','uses'=>'UserController@storeAvatar']);

        /* PLANNING */
        Route::get('project/{projectid}/planning', 'PlanningController@show')->where('projectid', '[0-9]+');

        /* COMMENTS */
        Route::get('tasks/{task}/comment',['as' => 'comment.show','uses' => 'CommentController@show'])->where('comment', '[0-9]+');
        Route::post('tasks/{task}/comment', ['as' => 'comment.store', 'uses' => 'CommentController@store']) -> where('comment', '[0-9]+');

        /* SEARCH */
        Route::get('project/{id}/search', ['as' => 'search.show', 'uses' => 'SearchController@show']);
        Route::post('project/{id}/search', ['as' => 'search.store', 'uses' => 'SearchController@store']);

        /* EVENTS */
        Route::get('project/{id}/events', ['as' => 'project.events', 'uses' => 'EventController@show'])->where('id', '[0-9]+');
        Route::get('project/{id}/formEvents', ['as' => 'project.formEvents', 'uses' => 'EventController@formEvent'])->where('id', '[0-9]+');
        Route::post('project/{id}/events', ['as' => 'project.storeEvents', 'uses' => 'EventController@store'])->where('id', '[0-9]+');


    });
});
