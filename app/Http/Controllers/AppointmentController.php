<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;
use App\Appointment;
use Auth;
use Cake\Chronos\Chronos;

class AppointmentController extends Controller
{
	public function __construct()
	{

		$this->middleware('auth');

	}

	public function add(Request $request)
	{

		$resource = Appointment::create(
			'title' => $request->title,
			'description' => $request->description,
			'start' => new Chronos($request->start),
			'end' => new Chronos($request->end),
			'resource_id' => $request->resource_id
		);

	}

	public function index()
	{

		$resources = Resource::pluck('id', 'title')->get();

		return response()->json($resources);

	}

}