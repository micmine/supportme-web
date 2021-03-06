<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Template;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{
		$chats = Auth::user()->chats();

		if ($chats->count() === 1) {
			if (Auth::user()->isUser()) {
				$chat = $chats->first->name;
				return redirect(route('chat.show.own'));
			}
		}

		$templates = Template::all();

		return view('home', [
			// side bar
			'chat_num' => $chats->count(),
			'chats' => $chats,
			// form
			'templates' => $templates
		]);
	}
}
