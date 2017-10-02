<?php

namespace App\Models\Records;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = 'au_record';
    protected $fillable = [
        'title',
        'title_seo',
        'record_type_id',
        'thumbnail_id',
        'user_id',
        'lang_id'
    ];
    public function record_type(){
        return $this->belongsTo('App\Models\Records\Record_Type', 'record_type_id');
    }
    public function visits(){
        return $this->hasMany('App\Models\Records\Visit', 'record_id');
    }
    //**********
    public function post(){
        return $this->hasOne('App\Models\Records\Post', 'id');
    }
    public function thumbnail(){
        return $this->belongsTo('App\Models\Files\File', 'thumbnail_id');
    }
    public function lang(){
        return $this->belongsTo('App\Models\Language', 'lang_id');
    }
}
