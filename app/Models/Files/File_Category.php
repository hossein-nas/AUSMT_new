<?php

namespace App\Models\Files;

use Illuminate\Database\Eloquent\Model;

class File_Category extends Model
{
    protected $table = 'au_file_category';
    protected $fillable = [
        'name',
        'base_dir_path',
        'dir_name',
        'removable',
        'description',
        'parent_category_id'
    ];

    public function parent_cat()
    {
        return $this->belongsTo('App\Models\Files\File_Category', 'parent_category_id');
    }
    public function sub_cats()
    {
        return $this->hasMany('App\Models\Files\File_Category', 'parent_category_id');
    }
    public function files(){
        return $this->hasMany('App\Models\Files\File', 'file_category_id');
    }    
}
