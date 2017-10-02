<?php

namespace App\Models\Records\Posts;

use Illuminate\Database\Eloquent\Model;

class Incoming extends Model
{
    protected $table = 'au_incoming_event';
    protected $touches = ['orig'];
    public $dates = ['started_at', 'finished_at'];
    protected $fillable = [
        'id',
        'spot'
    ];
    public function orig(){
        return $this->belongsTo('App\Models\Records\Post', 'id');
    }
}
