<?php

namespace App\Models\Org;

use Illuminate\Database\Eloquent\Model;

class Org_Unit extends Model
{
    protected $table = 'au_org_unit';
    protected $fillable = [
        'unit_title',
        'unit_title_id',
        'description',
        'super_org_unit_id'
    ];

    public function roles()
    {
        return $this->hasMany('App\Models\Org\Org_Role', 'org_unit_id');
    }

    public function structures(){
        return $this->belongsToMany('App\Models\Org\Structure', 'au_org_unit__structure', 'org_unit_id', 'structure_id')
            ->withPivot(['started_at', 'finished_at']);
    }
}
