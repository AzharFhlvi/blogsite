@extends('layouts.template')

@section('content')
<!-- Main Content-->
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
                <button type="button" class="btn btn-sm {{ $post->published ? 'btn-primary' : 'btn-secondary' }}"
                    data-toggle="modal" data-target="#publishModal{{$post->id}}">
                    {{ $post->published ? 'Published' : 'Not Published' }}
                </button>
                <x-publish :post="$post" />
                <div class="post-actions">
                    <!-- Edit Button -->
                    <a href="{{ route('posts.edit', ['post'=>$post->slug]) }}" class="btn btn-sm btn-success">Edit</a>

                    <!-- Delete Button -->
                    <form action="{{ route('posts.destroy', ['post'=>$post->id]) }}" method="POST" class="d-inline"
                        id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Yakin mau hapus post ini?')">Delete</button>
                    </form>
                </div>
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
<footer class="border-top">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="#!">
                            <span class="fa-stack fa-lg">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#!">
                            <span class="fa-stack fa-lg">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#!">
                            <span class="fa-stack fa-lg">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                </ul>
                <div class="small text-center text-muted fst-italic">Copyright &copy; Your Website 2023</div>
            </div>
        </div>
    </div>
</footer>
@endsection