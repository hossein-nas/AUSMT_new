<?php

namespace App\Models\Files;

use Illuminate\Database\Eloquent\Model;

class File_Group_Type extends Model
{
    protected $table = 'au_file_group_type';
    protected $fillable = [
        'name'
    ];

    public function file_group()
    {
        return $this->hasMany('App\Models\Files\File_Group', 'file_group_type_id');
    }
}
