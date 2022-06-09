@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('admin.posts.update', $post->id)}}" method="POST">
            @method('PUT')
            @csrf
                <div class="form-group">
                    <label for="title"><h3>Titolo</h3></label>
                    <input type="text" class="form-control" id="title" placeholder="Titolo del post" name="title" value="{{old('title', $post->title)}}">
                </div>

                <div class="form-group d-flex flex-column">
                    <label for="content"><h3>Content</h3></label>
                    <textarea name="content" id="content" cols="30" rows="10" placeholder="Contenuto del post">
                        {{old('content', $post->content)}}
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="image"><h3>Image</h3></label>
                    <input type="url" class="form-control" name="image" id="image" placeholder="Immagine del post" value="{{old('image', $post->image)}}"></input>
                </div>

                <button type="submit" class="btn btn-warning">Modifica</button>
        </form>
    </div>
@endsection

@section('scripts')

@endsection