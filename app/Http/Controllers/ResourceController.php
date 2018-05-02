<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;
use Auth;

class ResourceController extends Controller
{
	public function __construct()
	{

		$this->middleware('auth');

	}

	public function add(Request $request)
	{

		$resource = Resource::create(
			'title' => $request->title
		);

	}

	public function index()
	{

		$resources = Resource::pluck('id', 'title')->get();

		return response()->json($resources);

	}

}