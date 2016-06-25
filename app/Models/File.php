<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model {

    /**
     * Generated
     */

    protected $table = 'files';
    protected $fillable = ['id', 'name', 'description', 'mime' , 'size' , 'url', 'project_id'];


    public function project() {
        return $this->belongsTo(\App\Models\Project::class, 'project_id', 'id');
    }


    public function delete(){

    }

}
