<?php

namespace App\Http\Controllers;

use App\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatMessageController extends Controller
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
		$request->validate([
			'chat_id' => 'required',
		]);

		$chatMessage = new ChatMessage();

		if (request()->exists('message')) {
			$chatMessage->message = request('message');
		}
		if (request('template') != 0) {
			$chatMessage->template_id = request('template');
		}
		$chatMessage->chat_id = request('chat_id');
		$chatMessage->user_id = Auth::user()->id;

		$chatMessage->save();
		Log::info('[user:' . Auth::user()->id . '] created chatMessage => [' . request('message') . ', ' . request('template') . ']');

		if (Auth::user()->isUser()) {
			return redirect()->route('chat.show.own');
		} else {
			return redirect()->route('chat.show', ['chat' => request('chat_id')]);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\ChatMessage  $chatMessage
	 * @return \Illuminate\Http\Response
	 */
	public function show(ChatMessage $chatMessage)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\ChatMessage  $chatMessage
	 * @return \Illuminate\Http\Response
	 */
	public function edit(ChatMessage $chatMessage)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\ChatMessage  $chatMessage
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, ChatMessage $chatMessage)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\ChatMessage  $chatMessage
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(ChatMessage $chatMessage)
	{
		//
	}
}
