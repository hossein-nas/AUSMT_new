<?php

namespace App\Models\Records;

use Illuminate\Database\Eloquent\Model;

class Mag_Group extends Model
{
    protected $table = 'au_publication_group';
    protected $touches = ['orig'];
    public $timestamps = false;
    protected $fillable = [
        'title',
        'publisher',
        'publication_period',
        'description'
    ];
    public function orig(){
        return $this->hasMany('App\Models\Records\Mag', 'publication_group_id');
    }
}
