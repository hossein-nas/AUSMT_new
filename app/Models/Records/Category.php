<?php

namespace App\Models\Records;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'au_post_category';
    protected $fillable = [
        'name',
        'parent_category_id',
    ];
    public function post(){
        return $this->belongsToMany('App\Models\Records\Post', 'au_post__post_category', 'post_category_id', 'post_id');
    }
}
