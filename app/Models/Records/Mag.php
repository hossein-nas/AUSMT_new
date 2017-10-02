<?php

namespace App\Models\Records;

use Illuminate\Database\Eloquent\Model;

class Mag extends Model
{
    protected $table = 'au_mag_and_pub';
    protected $touches = ['orig'];
    public $timestamps = false;
    protected $fillable = [
        'id',
        'title',
        'description',
        'pub_no',
        'publication_group_id'
    ];
    public function orig(){
        return $this->belongsTo('App\Models\Records\Record', 'id');
    }
    public function mag_group(){
        return $this->belongsTo('App\Models\Records\Mag_Group', 'publication_group_id');
    }
}
