<?php

namespace App\Models\Files;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'au_gallery';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'description'
    ];

    public function file_group()
    {
        return $this->belongsTo('App\Models\Files\File_Group', 'id');
    }
}
