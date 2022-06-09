@extends('layouts.app')

@section('content')
    <div class="container">

        @if ( session('message') )
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="pb-4">
            <a href="{{route('admin.posts.create')}}" class="btn btn-success">Crea post</a>
        </div>
        

        <table class="table table-dark">
            <thead>
                <tr>
                <th scope="col">Titolo</th>
                <th scope="col">Contenuto</th>
                <th scope="col">Immagine</th>
                <th scope="col">Slug</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <th>{{$post->title}}</th>
                        <td>
                            
                            @if($post->category)
                                <span class="badge badge-pill badge-{{$post->Category->color}}">{{$post->Category->label}}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <p>{{$post->content}}</p>
                        </td>
                        <td>
                            <img src="{{$post->image}}" alt="{{$post->title}}">
                        </td>
                        <td>{{$post->slug}}</td>
                        <td class="d-flex">
                            <a href="{{route('admin.posts.show', $post->id)}}" class="btn btn-primary">View</a>
                            <!-- <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST" class="delete-form">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form> -->
                            @include('includes.deletePost')
                            <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-warning">Edit</a>
                        </td>
                    </tr>
                @empty
                    <h2>Non ci sono post</h2>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('js/delete-form.js')}}"></script>
@endsection