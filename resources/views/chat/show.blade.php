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
                <p>{{ $message->message }}</p>
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

	    <inputfield></inputfield>
        </form>
    </footer>
</div>

@endsection
