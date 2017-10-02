<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'au_user_type';
    public $timestamps = false;
    protected $fillable = [
        'role_title',
        'role_title_en',
        'parent_role',
        'romevable',
        'description'
    ];

    public function users()
    {
        return $this->hasMany('App\Models\Users\User', 'user_type_id');
    }

    public function privileges()
    {
        return $this->belongsToMany('App\Models\Users\Privilege', 'au_user__privilege', 'user_type_id', 'privilege_id');
    }
}
