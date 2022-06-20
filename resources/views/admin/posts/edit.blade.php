@extends('layouts.app')

@section('content')
     <div class="container">

         <form action="{{route('admin.posts.update', $post->id)}}" method="POST">
            @method('PUT')
             @csrf
             <div class="form-group">
                 <label for="title">Titolo</label>
                 <input type="text" class="form-control" id="title" placeholder="titolo del post" name="title" value="{{old('title', $post->title )}}">
             </div>

             <div class="form-group">
                 <label for="content">Contenuto del post</label>
                 <textarea name="content" id="content" cols="30" rows="10" placeholder="Scrivi il contenuto del Post" value="{{old('content', $post->content )}}"></textarea>

             </div>


             <div class="form-group">

                 <label for="image">Immagine del post</label>
                 <input type="url" class="form-control" id="image" placeholder="URL dell'immagine" name="image" value="{{old('image', $post->image )}}">

             </div>

             <button type="submit" class="btn btn-success">Modifica</button>


         </form>


     </div>

@endsection

@section('scripts')
<!---->
@endsection
