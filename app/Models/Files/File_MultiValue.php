<?php

namespace App\Models\Files;

use Illuminate\Database\Eloquent\Model;

class File_MultiValue extends Model
{
    protected $table = 'au_file_multivalue';
    public $timestamps = false;
    protected $fillable = [
        'file_related_id',
        'file_fullpath',
        'ratio',
        'filesize',
        'width',
        'height'
    ];

    public function orig()
    {
        return $this->belongsTo('App\Models\Files\File', 'related_file_id');
    }
}
