<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;
use App\Appointment;
use Auth;
use Cake\Chronos\Chronos;
use Carbon\Carbon;
use App\Events\UpdateWaitlistEvent;

class AppointmentController extends Controller
{
	public function __construct()
	{

		$this->middleware('auth');

	}

	public function add(Request $request)
	{

		$resource = Appointment::create([
			'title' => $request->title,
			'description' => $request->description,
			'start' => !is_null($request->start) ? new Carbon($request->start) : null,
			'end' => !is_null($request->end) ? new Carbon($request->end) : null,
			'resource_id' => $request->resource_id
		]);

		if(is_null($request->start) || $is_null($request->end)) {

			event(new UpdateWaitlistEvent($resource->toArray()));
		}

		return response()->json($resource);

	}

	public function view($id)
	{

		$appt = Appointment::where('id', $id)->first();

		return response()->json($appt);

	}

	public function update($id, Request $request)
	{

		$appt = Appointment::updateOrCreate(
			[
				'id' => $id
			],
			[
				'title' => $request->title,
				'description' => $request->description,
				'start' => !is_null($request->start) ? new Carbon($request->start) : null,
				'end' => !is_null($request->end) ? new Carbon($request->end) : null,
				'resource_id' => $request->resource_id
			]

		);

		return response()->json($appt);

	}

	public function index(Request $request)
	{

		$outputData = [];

		$resources = Appointment::whereBetween('start', [$request->startDate, $request->endDate])
								->get();

		$resources->each(function ($r) use (&$outputData) {

			$outputData[] = array(
				'id' => $r->id,
				'resourceId' => $r->resource_id,
				'title' => $r->title,
				'description' => $r->description,
				'start' => $r->start,
				'end' => $r->end
			);

		});

		return response()->json($outputData);

	}

}