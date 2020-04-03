@extends('layouts.dash')

@section('head')
	<link rel="stylesheet" href="{{ asset('css/chat.css') }}">
@endsection

@section('content')

	<h1 class="">{{ $chat->name }}</h1>
	<div class="chat-page">
		<div class="chat-container chat-push">
			@forelse ($messages as $message)
				<div class="chat-message {{ Auth::user()->id == $message->user_id ? 'chat-message-right' : 'chat-message-left' }}">
					<a href="">{{ App\User::find($message->user_id)->name }}</a>
					@if ($message->message != null)
						<p>{{ $message->message }}</p>
					@else
						<p>{{ App\Template::find($message->template_id)->message }}</p>
					@endif
				</div>
			@empty
				<div class="chat-message center">
					<p>Here are no messages</p>
				</div>
			@endforelse
		</div>

		<footer class="chat-form">
			<form action="{{ route('chatmessage.store') }}" method="POST">
				@csrf

				<input type="hidden" name="chat_id" value="{{ $chat->id }}">
				<div class="row">
					@if (!Auth::user()->isUser())
						<select class="form-control col-2" name="template">
							<option value="null">no</option>
							@foreach ($templates as $template)
								<option value="{{ $template->id }}">{{ $template->name }}</option>
							@endforeach
						</select>
						<input type="text" class="form-control col-8 pr-1" name="message" placeholder="message" autofocus>
						<button type="submit" class="col-2 btn btn-primary">send</button>
					@else
						<input type="text" class="form-control col-10 pr-1" name="message" placeholder="message" autofocus>
						<button type="submit" class="col-2 btn btn-primary">send</button>
					@endif
				</div>

			</form>
		</footer>
	</div>

@endsection
