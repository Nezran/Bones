<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    /**
     * Generated
     */
    public $timestamps = false;
    protected $table = 'roles';
    protected $fillable = ['id', 'name'];


    public function users() {
        return $this->hasMany(\App\Models\User::class, 'role_id', 'id');
    }


}
