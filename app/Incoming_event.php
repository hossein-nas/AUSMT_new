<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incoming_event extends Model {

	protected $fillable = [
		'title',
		'hifen_title',
		'content',
		'expired_date'
	];

	protected $dates = [ 'expired_date' ];

	public function author()
	{
		return $this->belongsTo('App\User');
	}
}
