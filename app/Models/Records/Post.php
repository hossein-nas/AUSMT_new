<?php

namespace App\Models\Records;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'au_post';
    protected $touches = ['orig'];
    public $timestamps = false;
    protected $appends = ['briefDescription'];
    protected $fillable = [
        'id',
        'content',
        'is_important'
    ];
    public function orig(){
        return $this->belongsTo('App\Models\Records\Record', 'id');
    }
    public function comments(){
        return $this->hasMany('App\Models\Records\Comment', 'post_id');
    }
    public function categories(){
        return $this->belongsToMany('App\Models\Records\Category', 'au_post__post_category', 'post_id', 'post_category_id');
    }
    public function tags(){
        return $this->belongsToMany('App\Models\Records\Tag',  'au_post__tag', 'post_id', 'tag_id');
    }
    public function seminar(){
        return $this->hasOne('App\Models\Records\Post\Seminar', 'id');
    }
    public function incoming(){
        return $this->hasOne('App\Models\Records\Post\Incoming', 'id');
    }


    public function getBriefDescriptionAttribute(){
        $plain_text = trim (strip_tags($this->content) );
        $pos = strpos($plain_text, ' ', 210);
        $text = substr($plain_text,0, $pos);
        return $text. ' ...';
    }

}
