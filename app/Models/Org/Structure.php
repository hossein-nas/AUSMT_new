<?php

namespace App\Models\Org;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    protected $table = 'au_structure';
    protected $fillable = [
        'name',
        'floor_count',
        'address',
        'google_map',
        'description'
    ];

    public function rooms()
    {
        return $this->hasMany('App\Models\Org\Room', 'stucture_id');
    }

    public function units()
    {
        return $this->belongsToMany('App\Models\Org\Org_Unit', 'au_org_unit__structure', 'structure_id', 'org_unit_id')
            ->withPivot(['started_at', 'finished_at']);
    }
}
