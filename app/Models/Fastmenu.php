<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fastmenu extends Model
{
    protected $table = 'au_fastmenu';
    protected $fillable = [
        'title',
        'uri',
        'lang_id',
        'svg_icon_id',
        'prev'
    ];

    public function lang()
    {
        return $this->belongsTo('App\Language', 'lang_id');
    }

    public function next()
    {
        return $this->hasOne('App\Models\Fastmenu', 'prev');
    }

    public function prev()
    {
        return $this->belongsTo('App\Models\Fastmenu', 'prev');
    }

    public function icon()
    {
        return $this->belongsTo('App\Models\Files\File', 'svg_icon_if');
    }
}
