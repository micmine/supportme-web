@extends('layouts.dash')

@section('content')

<h1 class="text-center mt-5 pt-5">{{ $chat->name }}</h1>

<p>here is some text</p>

@forelse ($messages as $message)
    <p>{{ $message }}</p>
@empty
    <p>No messages</p>
@endforelse

@endsection
