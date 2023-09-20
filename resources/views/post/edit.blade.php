@extends('layouts.template')

@section('content')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<header class="masthead" style="background-image: url('{{ $media->getUrl() }}')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>{{ $post->title }}</h1>
                    <span class="subheading">{{ $post->subtitle }}</span>
                </div>
            </div>
        </div>
    </div>
</header>

<main>
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <form action="{{ route('posts.update', ['post'=>$post->slug]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="image">Image</label>
                    <input class="form-control" type="file" name="image">
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" placeholder="Title" class="form-control" value="{{ $post->title }}">
                </div>
                <div class="form-group">
                    <label for="subtitle">Subtitle</label>
                    <textarea name="subtitle" placeholder="Subtitle" class="form-control">{{ $post->subtitle }}</textarea>
                </div>
                <div class="form-group">
                    <label for="body">Content</label>
                    <textarea  name="body" id="body" class="form-control">
                        {{ $post->body }}
                    </textarea>
                    <script>
                        ClassicEditor
                            .create( document.querySelector( '#body' ) )
                            .catch( error => {
                                console.error( error );
                            } );
                    </script>
                </div>
                <div class="form-check form-switch">
                    @if ($post->published)
                    <input class="form-check-input" type="checkbox" role="switch" id="publish" name="publish" checked>
                    @else
                    <input class="form-check-input" type="checkbox" role="switch" id="publish" name="publish">
                    @endif
                    <label class="form-check-label" for="publish">Publish</label>
                </div>
                
                

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>


</main>
@endsection