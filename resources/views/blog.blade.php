@extends('layouts.template')

@section('content')
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            @foreach ($posts as $post)

            <!-- Post preview-->
            <div class="post-preview">
                <a href="{{ route('posts.show', ['post'=>$post->slug]) }}">
                    <h2 class="post-title">{{ $post->title }}</h2>
                    <h3 class="post-subtitle">{{ $post->subtitle }}</h3>
                </a>
                <p class="post-meta">
                    Posted by {{ $post->user->name }}
                    on {{ \Carbon\Carbon::parse($post->published_at)->format('F d, Y') }}
                </p>
            </div>

            <!-- Divider-->
            <hr class="my-4" />
            @endforeach
            <!-- Pager-->
            <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts
                    →</a></div>
        </div>
    </div>
</div>
<!-- Footer-->
@include('layouts.footer')
@endsection