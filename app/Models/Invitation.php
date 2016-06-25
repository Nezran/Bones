<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model {

    /**
     * Generated
     */

    protected $table = 'invitations';
    protected $fillable = ['token', 'status', 'guest_id', 'host_id', 'project_id'];


    public function project() {
        return $this->belongsTo(\App\Models\Project::class, 'project_id', 'id');
    }

    public function guest() {
        return $this->belongsTo(\App\Models\User::class, 'guest_id', 'id');
    }

    public function host() {
        return $this->belongsTo(\App\Models\User::class, 'host_id', 'id');
    }


}
