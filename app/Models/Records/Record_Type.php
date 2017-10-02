<?php

namespace App\Models\Records;

use Illuminate\Database\Eloquent\Model;

class Record_Type extends Model
{
    protected $table = 'au_record_type';
    protected $fillable = [
        /*
        'name',
        'name_fa',
        'parent_record_type_id'
        */
    ];

    public function records()
    {
        return $this->hasMany('App\Models\Records\Record', 'record_type_id');
    }
}
