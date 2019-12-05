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

                <div>
                    <a href="{{ route('profile.show', ['profile' => $post->user->profile]) }}">{{ $post->user->name }}</a>
                    <span>{{ $post->created_at }}</span>
                </div>

                @isset($post->image)
                    <img class="img-fluid" src="{{ asset($post->image) }}" alt="{{ $post->title }}">
                @endisset

                <p>{{ $post->body }}</p>

                <h2>Comments</h2>
                @forelse ($post->comments as $comment)
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('profile.show', ['profile' => $comment->user->profile]) }}">{{ $comment->user->name }}</a>
                            <span>{{ $comment->created_at }}</span>
                        </div>

                        <div class="card-body">
                            <p>{{ $comment->body }}</p>
                        </div>
                    </div>
                @empty
                    <p>There are no comments to display</p>
                @endforelse

                    <comments :post="{{ $post }}"></comments>
            </div>
        </div>
    </div>
@endsection
