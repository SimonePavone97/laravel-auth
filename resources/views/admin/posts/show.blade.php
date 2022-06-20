@extends('layouts.app')

@section('content')
<div class="container">
    <img src="{{$post->image}}" alt="{{$post->title}}" width="50%">
    <h2>{{$post->title}}</h2>
    <p>{{$post->content}}</p>


    @include('includes.deletePost')


</div>
@endsection

@section('scripts')
<script src="{{asset('js/delete-form.js')}}"></script>
@endsection
 