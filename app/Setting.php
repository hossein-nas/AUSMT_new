<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {

	protected $fillable = [
		'name',
		'value',
		'set_type'
	];

	public function scopeAllQuickAccess($query)
	{
		return $query->where('set_type', 1);
	}

	public function scopeAllLinks($query)
	{
		return $query->where('set_type', 2);
	}
}
