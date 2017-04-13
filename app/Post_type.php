<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_type extends Model {

	public $timestamps = FALSE;

	public function posts()
	{
		return $this->hasMany('App\Post');
	}
}
