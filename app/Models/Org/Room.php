<?php

namespace App\Models\Org;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'au_room';
    protected $fillable = [
        'room_title',
        'room_number',
        'structure_floor',
        'description',
        'structure_id'
    ];

    public function structure()
    {
        return $this->belongsTo('App\Models\Org\Structure', 'structure_id');
    }
    public function person()
    {
        return $this->hasMany('App\Models\Org\Person', 'room_id');
    }
}
