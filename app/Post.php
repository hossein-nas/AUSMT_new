<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {

	protected $fillable = [
		'title',
		'hifen_title',
		'content',
		'user_id',
		'post_type_id',
		'image',
		'visit',
		'addToSlider',
		'expired_at',
		'priority'
	];
	protected $dates = [ 'expired_at' ];

	// author
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	//type
	public function posttype()
	{
		return $this->belongsTo('App\Post_type', 'post_type_id');
	}

	//comments
	public function comments()
	{
		return $this->hasMany('App\Comment');
	}

	public function scopeAllSliderItems($query)
	{
		return $query->where('addToSlider', 1)->limit(10)->latest();
	}

	public function scopeAllIncoming($query, $expired = FALSE)
	{
		if ( $expired )
			$query->where('expired_at', '>=', Carbon::now());
		return $query->where('post_type_id', 6)->oldest('expired_at');
	}

	public function scopeAllPost($query, $limit = FALSE)
	{
		if ( $limit )
			$query->limit(6);

		return $query->where('post_type_id', 1)->latest();
	}

	public function scopeAllPage($query)
	{
		return $query->where('post_type_id', 2)->latest();
	}

	public function scopeAllNotfication($query, $limit = FALSE)
	{
		if ( $limit )
			$query->limit(6);

		return $query->where('post_type_id', 3)->latest();
	}

	public function scopeAllSeminar($query, $limit = FALSE)
	{
		if ( $limit )
			$query->limit(6);

		return $query->where('post_type_id', 4)->latest();
	}

	public function scopeAllOther($query, $limit = FALSE)
	{
		if ( $limit )
			$query->limit(10);

		return $query->where('post_type_id', 5)->latest();
	}


	public function scopeByHifenTitle($query, $hifen)
	{
		return $query->where('hifen_title', $hifen);
	}

	public function scopeHotPosts($query, $limit = 10)
	{
		return $query->where('priority', 1)->limit($limit)->latest();
	}

	public function scopePost($query, $hifen)
	{
		return $query->where('post_type_id', 1)->where('hifen_title', $hifen)->first();
	}

	public function scopePage($query, $hifen)
	{
		return $query->where('post_type_id', 2)->where('hifen_title', $hifen)->first();
	}

	public function scopeNotfication($query, $hifen)
	{
		return $query->where('post_type_id', 3)->where('hifen_title', $hifen)->first();
	}

	public function scopeSeminar($query, $hifen)
	{
		return $query->where('post_type_id', 4)->where('hifen_title', $hifen)->first();
	}

	public function scopeOther($query, $hifen)
	{
		return $query->where('post_type_id', 5)->where('hifen_title', $hifen)->first();
	}

	public function scopeIncoming($query, $hifen)
	{
		return $query->where('post_type_id', 6)->where('hifen_title', $hifen)->first();
	}

	public function getIncreaseAttribute()
	{
		$this->visit ++;
		$this->save();
	}

}
