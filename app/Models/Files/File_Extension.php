<?php

namespace App\Models\Files;

use Illuminate\Database\Eloquent\Model;

class File_Extension extends Model
{
    protected $table = 'au_file_extension';
    public $timestamps = false;
    protected $fillable = [
        'extension',
        'mimetype',
        'file_type_id',
        'file_icon_id'
    ];

    public function filetype()
    {
        return $this->belongsTo('App\Models\Files\File_Type', 'file_type_id');
    }

    public function files()
    {
        return $this->hasMany('App\Models\Files\File', 'extension_id');
    }
    public function icon(){
        return $this->belongsTo('App\Models\Files\File', 'file_icon_id');
    }
}
