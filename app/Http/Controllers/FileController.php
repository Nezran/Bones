<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\File as Filestorage;
use Auth;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Http\Requests;

class FileController extends Controller
{
    public function show(){

    }

    public function store(Project $project, Request $request, $id)
    {


        $file = Input::file('file');

        $destinationPath = 'files/'.$id.'/';

        $fileArray = array('files' => $file);

        $rules = array(
            'files' => 'required|max:1000000'
        );

        $validator = Validator::make($fileArray, $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->getMessages()], 400);
        } else {
            $extension = $file->getClientOriginalExtension();
            $hash = $file->hashName();
            $fileName = $file->getClientOriginalName();
            $file->move($destinationPath, $hash);
            $store = new File;
            $store->name = $file->getClientOriginalName();
            $store->description = $request->input('description');
            $store->mime = $extension;
            $store->size = $file->getClientSize();
            $store->description = $request->input('description');
            $store->url = $hash;
            $store->project_id = $id;
            $store->save();
        };

        return redirect("project/" . $id);

    }

    public function destroy($id,File $file){
        //dd($file->id);


        if(Storage::disk('local')->exists('public/files/'.$id.'/'.$file->url)){
            Storage::delete('public/files/'.$id.'/'.$file->url);
        }else{
            echo "File not exist";
        }

        File::where('id','=',$file->id)->delete();

    }
}
