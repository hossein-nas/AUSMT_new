<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

	protected $fillable = [
		'username',
		'email',
		'content',
		'parent_id',
		'verified',
		'post_id'
	];

	public function post()
	{
		return $this->belongsTo('App\Post');
	}

	public function hasParent()
	{
		if ( $this->parent_id == 0 )
			return FALSE;
		$count = Comment::findOrFail($this->parent_id)->where('verified', 1)->first()->count();
		if ( $count )
		{
			return TRUE;
		} else
			return FALSE;
	}

	public function getParentAttribute()
	{
		if ( ( $this->parent_id != 0 ) )
		{
			return Comment::findOrFail($this->parent_id);
		} else
			return FALSE;
	}

	public function scopeVerifiedCm($query)
	{
		return $query->where('verified', 1);
	}

	public function scopeUnverifiedCm($query)
	{
		return $query->where('verified', 0);
	}

	public function scopeLast10($query)
	{
		return $query->where('verified', 1)->limit(10)->latest('updated_at');
	}
}
