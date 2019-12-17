@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <h1>Posts</h1>

                @can('create', 'App\Post')
                    <p>Can't find what you're looking for? <a href="{{ route('posts.create') }}" class="btn btn-primary ml-2">Create a post</a></p>
                @endcan

                <div class="row">
                    @foreach ($posts as $post)
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <img src="{{ asset($post->image) }}" class="card-img-top" alt="{{ $post->title }}">

                                <div class="card-body">
                                    <p class="card-title h5">
                                        <a class="stretched-link" href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->title }}</a>
                                    </p>
                                    <p class="card-subtitle mb-2 text-muted">{{ $post->created_at->format('j F Y') }}</p>
                                    <p class="card-text">{{ $post->teaser }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
