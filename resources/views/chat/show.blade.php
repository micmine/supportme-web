@extends('layouts.dash')

@section('content')

<h1 class="text-center mt-5 pt-5">{{ $chat->name }}</h1>

@forelse ($messages as $message)
    {{ $message->message }}
@empty
    no messages
@endforelse

@endsection
