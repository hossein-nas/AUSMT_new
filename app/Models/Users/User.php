<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    protected $table = 'au_user';
    public $dates = ['activated_at'];
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'remember_token',
        'activated',
        'activated_at',
        'user_type_id',
        'thumbnail_id'
    ];

    public function type()
    {
        return $this->belongsTo('App\Models\Users\Role', 'user_type_id');
    }

    public function photo()
    {
        return $this->belongsTo('App\Models\Files\File', 'thumbnail_id');
    }
    public function composed(){
        return $this->hasMany('App\Models\Records\Record', 'user_id');

    }
}
