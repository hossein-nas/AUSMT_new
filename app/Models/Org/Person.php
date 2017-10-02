<?php

namespace App\Models\Org;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'au_person';
    protected $fillable = [
        'id_code',
        'name',
        'email',
        'personal_homepage',
        'telephone',
        'extension',
        'bio',
        'thumbnail_id',
        'room_id'
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Org\Org_Role', 'au_org_role__person', 'person_id', 'role_id')->withPivot(['started_at', 'finished_at']);
    }

    public function photo()
    {
        return $this->belongsTo('App\Models\Files\File', 'thumbnail_id');
    }
    public function room()
    {
        return $this->belongsTo('App\Models\Org\Room', 'room_id');
    }
}
