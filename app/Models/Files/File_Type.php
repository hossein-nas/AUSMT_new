<?php

namespace App\Models\Files;

use Illuminate\Database\Eloquent\Model;

class File_Type extends Model
{
    protected $table = 'au_file_type';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'name_fa'
    ];

    public function extensions()
    {
        return $this->hasMany('App\Models\Files\File_Extension', 'file_type_id');
    }

}
