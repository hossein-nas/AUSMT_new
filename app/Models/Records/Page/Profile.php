<?php

namespace App\Models\Records\Page;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'au_profile_page';
    protected $fillable = [
        'id',
        'person_id'
    ];
    public function page(){
        return $this->belongsTo('App\Models\Records\Page', 'id');
    }
    public function person(){
        return $this->belongsTo('App\Models\Org\Person', 'person_id');
    }
}
