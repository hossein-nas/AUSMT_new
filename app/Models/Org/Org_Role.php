<?php

namespace App\Models\Org;

use Illuminate\Database\Eloquent\Model;

class Org_Role extends Model
{
    protected $table = 'au_org_role';
    protected $fillable = [
        'role_title',
        'role_title_en',
        'description',
        'superior_role_id',
        'org_unit_id',
        'duty_description',
        'duties'
    ];

    public function persons()
    {
        return $this->belongsToMany('App\Models\Org\Person', 'au_org_role__person', 'role_id', 'person_id')->withPivot(['started_at', 'finished_at']);
    }

    public function superior()
    {
        return $this->belongsTo('App\Models\Org\Org_Role', 'superior_role_id');
    }

    public function sub_roles()
    {
        return $this->hasMany('App\Models\Org\Org_Role', 'superior_role_id');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\Org\Org_Unit', 'org_unit_id');
    }

}
