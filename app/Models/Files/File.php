<?php

namespace App\Models\Files;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'au_file';
    protected $fillable = [
        'orig_name',
        'name',
        'title',
        'description',
        'responsive_image',
        'extension_id',
        'file_category_id'
    ];

    public function specs()
    {
        return $this->hasMany('App\Models\Files\File_MultiValue', 'related_file_id');
    }

    public function extension()
    {
        return $this->belongsTo('App\Models\Files\File_Extension', 'extension_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Files\File_Category', 'file_category_id');
    }

    public function groups()
    {
        return $this->belongsToMany('App\Models\Files\File_Group', 'au_file__file_group', 'file_id', 'file_group_id');
    }
}
