<?php

namespace App\Models\Records\Posts;

use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    protected $table = 'au_seminar';
    protected $touches = ['orig'];
    public $dates = ['started_at', 'finished_at'];
    protected $fillable = [
        'id',
        'spot',
        'major_subject',
        'summary',
        'website',
    ];
    public function orig(){
        return $this->belongsTo('App\Models\Records\Post', 'id');
    }
}
