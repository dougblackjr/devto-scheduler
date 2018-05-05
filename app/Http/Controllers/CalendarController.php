<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use App\Resource;

class CalendarController extends Controller
{

	public function getWaitList()
	{

		$appointments = Appointment::where('start', null)->where('end', null)->get();

		return response()->json($appointments);

	}

}
