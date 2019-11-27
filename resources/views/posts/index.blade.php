@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <h1>Posts</h1>

                @can('create', 'App\Post')
                    <div>
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create post</a>
                    </div>
                @endcan

                @foreach ($posts as $post)
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->title }}</a>
                            <span>{{ $post->created_at }}</span>
                        </div>
                        <div class="card-body">
                            <p>{{ $post->body }}</p>
                        </div>
                    </div>
                @endforeach

                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
