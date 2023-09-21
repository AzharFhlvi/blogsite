@extends('layouts.template')

@section('content')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>

<main>
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="image">Image</label>
                    <input class="form-control" type="file" name="image">
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" placeholder="Title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="subtitle">Subtitle</label>
                    <textarea name="subtitle" placeholder="Subtitle" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="body">Content</label>
                    <textarea name="body" id="body" class="form-control"></textarea>
                    <script>
                        ClassicEditor
                            .create( document.querySelector( '#body' ) )
                            .catch( error => {
                                console.error( error );
                            } );
                    </script>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="publish" name="publish">
                    <label class="form-check-label" for="publish">Publish</label>
                </div>



                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>


</main>
@endsection