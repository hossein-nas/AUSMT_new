<?php

namespace App\Models\Records;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'au_comment';
    protected $fillable = [
        'name',
        'email',
        'content',
        'verified',
        'verified_at',
        'post_id',
        'parent_cm_id'
    ];
    public function post(){
        return $this->belongsTo('App\Models\Records\Post', 'post_id');
    }
    public function children(){
        return $this->hasMany('App\Models\Records\Comment', 'parent_cm_id');
    }
    public function parent(){
        return $this->belongsTo('App\Models\Records\Comment', 'parent_cm_id');
    }
}
