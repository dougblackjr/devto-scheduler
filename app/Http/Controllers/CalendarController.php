<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\LockHelper;
use App\Appointment;
use App\Resource;

class CalendarController extends Controller
{

	public function __construct()
	{

		$this->middleware('auth');

	}

	public function getWaitList()
	{

		$appointments = Appointment::where('start', null)->where('end', null)->get();

		$appointments->each(function ($a) {

			$a->locked = LockHelper::has('wait', $a->id);

			if($a->locked) {

				$lockInfo = LockHelper::get('wait', $a->id);

				$a->description = $lockInfo;

			}

			return $a;

		});

		return response()->json($appointments);

	}

}
