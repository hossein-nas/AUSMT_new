<?php

namespace App\Models\Records;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $table = 'au_visit';
    protected $fillable = [
        'record_id',
        'uri',
        'ip',
        'redirect_uri',
        'user_agent',
        'request_time'
    ];
    public function record(){
        return $this->belongsTo('App\Models\Records\Record', 'record_id');
    }
}
