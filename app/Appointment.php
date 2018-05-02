<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
	use SoftDeletes;

	protected $table = 'events';

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	protected $fillable = ['title', 'description', 'start', 'end', 'resource_id'];

	public function resource() {

		return $this->belongsTo('App\Resource');

	}

}
