<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Navbar extends Model {

	protected $fillable = [
		'name',
		'href',
		'parent_id'
	];

	public function scopeAllNavByParent($query, $parent = 0)
	{
		return $query->where('parent_id', $parent)->oldest();
	}
}
