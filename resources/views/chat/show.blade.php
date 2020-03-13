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
                <a href="">{{ App\User::find($message->user_id)->email }}</a>
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
            <div class="row">
                <input type="hidden" name="chat_id" value="{{ $chat->id}}">
                <input type="text" class="form-control col-10 pr-1" name="message" placeholder="message">
                <button type="submit" class=" col-2 btn btn-primary">send</button>
            </div>
        </form>
    </footer>
</div>

@endsection
