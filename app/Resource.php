<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{
	use SoftDeletes;

	protected $table = 'resources';

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	protected $fillable = ['title'];

	public function events() {

		return $this->hasMany('App\Event');

	}

}
