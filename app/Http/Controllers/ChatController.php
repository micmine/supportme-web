<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Template;
use App\ChatMessage;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
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
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Chat  $chat
	 * @return \Illuminate\Http\Response
	 */
	public function show(Chat $chat = null)
	{
		if ($chat === null) {
			$chat = Auth::user()->chats()->first();
		}

		if (Auth::user()->isUser()) {
			$available = Auth::user()->chats()->where('name', $chat->name)->first();

			if ($available != null) {
				if (!$available->exists()) {
					abort(403);
				}
			} else {
				abort(404);
			}
		}

		$messages = ChatMessage::where('chat_id', $chat->id)->get();
		$templates = Template::all();

		return view('chat.show', [
			'chat' => $chat,
			'messages' => $messages,
			// side bar
			'chats' => Auth::user()->chats(),
			// form
			'templates' => $templates
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Chat  $chat
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Chat $chat)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Chat  $chat
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Chat $chat)
	{
		if (Auth::user()->isUser()) {
			abort(403);
		}

		$direction = request('direction');
		$current = $chat->getSupportLevel();
		$next = 2;

		if ($direction == 'up') {
			if ($current != 3) {
				$next = $current + 1;
			}
		} else {
			if ($current != 1) {
				$next = $current - 1;
			}
		}
		$chat->removeGroup(Group::where('name', 'supportlevel-' . $current)->first());
		$chat->addGroup(Group::where('name', 'supportlevel-' . $next)->first());

		Log::info("Set supportlevel of chat => [" . $chat->id . "] to [" . $next . "]");

		if (Auth::user()->isUser()) {
			return redirect()->route('chat.show.own');
		} else {
			return redirect()->route('chat.show', ['chat' => $chat->id]);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Chat  $chat
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Chat $chat)
	{
		//
	}
}
