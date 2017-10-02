<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'au_language';
    protected $fillable = [
        'lang_name',
        'lang_name_en'
    ];
    public $timestamps = false;
}
