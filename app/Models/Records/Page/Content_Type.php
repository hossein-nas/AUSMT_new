<?php

namespace App\Models\Records\Page;

use Illuminate\Database\Eloquent\Model;

class Content_Type extends Model
{
    protected $table = 'au_content_type';
    protected $fillable = [
        'name',
        'name_fa'
    ];
}
