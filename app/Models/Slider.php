<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table='au_slider';
    public $dates = ['expired_at'];
    protected $fillable =[
        'title',
        'description',
        'visibility',
        'expired_at',
        'photo_id',
        'record_id',
        'lang_id'
    ];
    
    public function photos(){
        return $this->belongsTo('App\Models\Files\File', 'photo_id');
    }
    public function post(){
        return $this->belongsTo('App\Models\Records\Record', 'record_id');
    }
    public function lang(){
        return $this->belongsTo('App\Models\Language', 'lnag_id');
    }
}
