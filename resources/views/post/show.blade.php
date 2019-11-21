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

                <h1>{{ $post->title }}</h1>
                <p>{{ $post->user->name }} {{ $post->created_at }}</p>
                <p>{{ $post->body }}</p>

                <h2>Comments</h2>
                @forelse ($post->comments as $comment)
                    <div class="card">
                        <div class="card-header">{{ $comment->user->name }}</div>

                        <div class="card-body">
                            <p>{{ $comment->body }}</p>
                        </div>
                    </div>
                @empty
                    <p>There are no comments to display</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
