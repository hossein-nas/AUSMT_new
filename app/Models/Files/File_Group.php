<?php

namespace App\Models\Files;

use Illuminate\Database\Eloquent\Model;

class File_Group extends Model
{
    protected $table = 'au_file_group';
    protected $fillable = [
        'title',
        'file_group_type_id',
        'record_id'
    ];

    public function group_type()
    {
        return $this->hasMany('App\Models\Files\File_Group_Type', 'file_group_type_id');
    }

    public function galleries()
    {
        return $this->hasOne('App\Models\Files\Gallery', 'id');
    }

    public function files()
    {
        return $this->belongsToMany('App\Models\Files\File', 'au_file__file_group', 'file_group_id', 'file_id');
    }

    public function record(){
        return $this->belongsTo('App\Models\Records\Record', 'record_id');
    }
}
