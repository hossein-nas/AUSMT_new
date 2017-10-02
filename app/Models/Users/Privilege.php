<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    protected $table = 'au_privilege';
    public $timestamps = false;
    protected $fillable = [
        'id_name',
        'privilege_name',
        'privilege_name_en',
        'parent_privilege',
        'privilege_dependency',
        'description'
    ];
    public function roles(){
        return $this->belongsToMany('App\Models\Users\Role', 'au_user__privilege', 'privilege_id', 'user_type_id');
    }

}
