<?php

namespace App\Models\Records;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'au_page';
    protected $touches = ['orig'];
    public $timestamps = false;
    protected $fillable = [
        'id',
    ];
    public function orig(){
        return $this->belongsTo('App\Models\Records\Record', 'id');
    }
    public function profile(){
        return $this->hasOne('App\Models\Records\Page\Profile', 'id');
    }
}
