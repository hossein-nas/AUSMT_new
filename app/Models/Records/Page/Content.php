<?php

namespace App\Models\Records\Page;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'au_content';
    protected $fillable = [
        'content',
        'is_close',
        'page_id',
        'content_type_id',
        'prev',
        'parent'
    ];
    public function page(){
        return $this->belongsTo('App\Models\Records\Page', 'page_id');
    }
    public function parent(){
        return $this->belongsTo('App\Models\Records\Page\Content', 'parent');
    }
    public function prev(){
        return $this->belongsTo('App\Models\Records\Page\Content', 'prev');
    }
    public function next(){
        return $this->hasOne('App\Models\Records\Page\Content', 'prev');
    }
    public function type(){
        return $this->belongsTo('App\Models\Records\Page\Content_Type', 'content_type_id');
    }
}
