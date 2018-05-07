<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\LockHelper;
use Illuminate\Support\Facades\Redis;
use App\Events\LockApptEvent;
use App\Events\LockTimeSlotEvent;
use App\Events\LockWaitlistEvent;
use Auth;

class LockController extends Controller
{

	protected $redisConnection;
	protected $user;

	public function __construct()
	{
		$this->middleware('auth');

		$this->redisConnection = Redis::connection();

	}

	public function lock(Request $request)
	{

		$this->user = Auth::user();

		$type = $request->type;

		switch ($type) {
			case 'wait':
				$lock = $this->lockWaitList($request->id);
				event(new LockWaitlistEvent($lock));
				break;
			
			case 'appt':
				$lock = $this->lockAppointment($request->id);
				event(new LockApptEvent($lock));
				break;

			case 'slot':
				$id = $request->id;
				$date = $request->date;
				$data = $request->data;
				$lock = $this->lockSlot($id, $date, $data);
				event(new LockTimeSlotEvent($lock));
				break;

			default:
				return response()->json(['result' => 'BORK']);
				break;
		}

		return response()->json($lock);

	}

	public function unlock (Request $request)
	{

		$type = $request->type;

		switch ($type) {
			case 'wait':
				$lock = $this->unlockWaitList($request->id);
				event(new LockWaitlistEvent($lock));
				break;
			
			case 'appt':
				$lock = $this->unlockAppointment($request->id);
				event(new LockApptEvent($lock));
				break;

			case 'slot':
				$id = $request->id;
				$date = $request->date;
				$data = $request->data;
				$lock = $this->unlockSlot($id, $date, $data);
				event(new LockTimeSlotEvent($lock));

			default:
				return response()->json(['result' => 'BORK']);
				break;
		}

		return response()->json($lock);

	}

	private function lockWaitList($id)
	{

		$this->redisConnection->set('lock:wait:' . $id, $this->user->id);

	}

	private function lockAppointment($id)
	{

		$this->redisConnection->set('lock:appt:' . $id, $this->user->id);

	}

	private function lockSlot($id, $date, $data)
	{

		$this->redisConnection->set('lock:slot:' . $id . ':' . $date . ':' . $data, $this->user->id);

	}

	private function unlockWaitList($id)
	{

		$this->redisConnection->del('lock:wait' . $id);

	}

	private function unlockAppointment($id)
	{

		$this->redisConnection->del('lock:appt' . $id);

	}

	private function unlockSlot($id, $date, $data)
	{

		$this->redisConnection->del('lock:slot:' . $id .':' . $date . ':' . $data);

	}

	public function has(Request $request)
	{

		$type = $request->type;

		$id = $request->has('id') ? $request->id : null;

		$answer = LockHelper::has($type, $id);

		return $answer ? 'TRUE' : 'FALSE';

	}

}