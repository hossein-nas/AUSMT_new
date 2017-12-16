<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navigationbar extends Model
{
    protected $table = 'au_navigation_bar';
    protected $fillable = [
        'title',
        'uri',
        'lang_id',
        'prev',
        'parent_id',
        'navbar_type_id'
    ];

    public function parentNav()
    {
        return $this->belongsTo('App\Models\Navigationbar', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Navigationbar', 'parent_id');
    }
    
    public function nextNav(){
        return $this->hasOne('App\Models\Navigationbar', 'prev');
    }
    public function prevNav(){
        return $this->belongsTo('App\Models\Navigationbar', 'prev');
    }

    public function lang()
    {
        return $this->belongsTo('App\Models\Language', 'lang_id');
    }

    public function type(){
        return $this->belongsTo('App\Models\Navbar_Type', 'navbar_type_id');
    }
}
