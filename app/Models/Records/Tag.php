<?php

namespace App\Models\Records;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'au_tag';
    protected $fillable = [
        'name'
    ];
    public function post(){
        return $this->belongsToMany('App\Models\Records\Post', 'au_post__tag', 'tag_id', 'post_id');
    }
}
