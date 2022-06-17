@extends('layouts.app')

@section('content')
    <div class="container">
        <img src="{{$post->image}}" alt="{{$post->title}}">
        <h2>{{$post->title}}</h2>
        <p>{{$post->content}}</p>
    </div>
@endsection