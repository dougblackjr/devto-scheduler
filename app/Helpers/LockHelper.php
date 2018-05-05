<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;

class LockHelper {

	/**
	 * locks an object
	 * @param  [string] $type  [name of type of object to get keys for. Required]
	 * @param  [integer] $id   [ID of key to lock.]
	 * @param  [string] $data. [Data to store in lock, defaults to date and time of now]
	 * @return [string]        [OK]
	 */
	public static function lock($type, $id, $data = null)
	{

		$redisConnection = Redis::connection();

		$data = is_null($data) ? Carbon::now()->toDateTimeString() : $data;

		$lock = $redisConnection->set('lock:' . $type . ':' . $id, $data);

		// Let's set an expiration date
		$redisConnection->expire('lock:' . $type . ':' . $id, 600);

		return $lock;

	}

	/**
	 * unlocks an object
	 * @param  [string] $type [name of type of object to get keys for. Required]
	 * @param  [integer] $id   [ID of key to unlock.]
	 * @return [string]       [1]
	 */
	public static function unlock ($type, $id)
	{

		$redisConnection = Redis::connection();

		$lock = $redisConnection->del('lock:' . $type . ':' . $id);

		return $lock;

	}

	/**
	 * gets list of keys
	 * @param  [string] $type [name of type of object to get keys for. Required]
	 * @param  [integer] $id   [ID of key to get. If null (default), will return all keys in that type]
	 * @return [array or string]       [if no $id, list of keys. If $id, value of key]
	 */
	public static function get($type, $id = null)
	{

		$redisConnection = Redis::connection();

		$call = !is_null($id) ? 'get' : 'keys';

		$locks = $redisConnection->{$call}('lock:' . $type. (!is_null($id) ? ':' . $id : '*'));

		return $locks;

	}

	/**
	 * checks if key exists
	 * @param  [string] $type [name of type of object to get keys for. Required]
	 * @param  [integer] $id   [ID of key to get. If null (default), will return all keys in that type]
	 * @return boolean
	 */
	public static function has($type, $id)
	{

		$redisConnection = Redis::connection();

		$locks = $redisConnection->keys('lock:' . $type. (!is_null($id) ? ':' . $id : '*'));

		return !empty($locks);

	}

	/**
	 * appends value to key
	 * @param  [string] $type  [name of type of object to get keys for. Required]
	 * @param  [integer] $id   [ID of key to get]
	 * @param  [type] $data    [data to append to string]
	 * @return [string]        [key id]
	 */
	public static function append($type, $id, $data)
	{
		$redisConnection = Redis::connection();

		$lock = $redisConnection->append('lock:' . $type . $id, $data);

		return $lock;
	}

	/**
	 * opposite of appends value to key
	 * @param  [string] $type  [name of type of object to get keys for. Required]
	 * @param  [integer] $id   [ID of key to get]
	 * @param  [type] $data    [data to un-append to string]
	 * @return [string]        [key id]
	 */
	public static function detach($type, $id, $data)
	{
		$redisConnection = Redis::connection();

		$lock = $redisConnection->get('lock:' . $type . ':' . $id);

		// Convert to array
		$lockData = explode(',', $lock);
		// dd($key = array_search($data, $lockData), $lock, $lockData, $type, $id, $data);
		// If value is in array
		if($key = array_search($data, $lockData) !== FALSE) {
			
			// remove it
			unset($lockData[array_search($data, $lockData)]);
			
			// Set key with expiration
			if(!empty($lockData)) {

				self::lock($type, $id, implode(',', $lockData));

			} else {

				self::unlock($type, $id);

			}

		}
		
		// Return whatever it gives ya
		return $lock;
	}

	public static function replace($type, $id, $oldData, $newData)
	{

		$redisConnection = Redis::connection();

		$lock = $redisConnection->get('lock:' . $type . ':' . $id);

		// Replace in string
		// dd('hurr', $lock, $oldData, $newData, strpos($oldData, $lock));
		self::unlock($type, $id);

		$lockData = str_replace($oldData, $newData, $lock);

		$lock = self::lock($type, $id, $lockData);
		
		// Return whatever it gives ya
		return $lock;

	}

}