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

                <h1>{{ $post->title }}</h1>

                @can('update', $post)
                    <div>
                        <a href="{{ route('posts.edit', ['post' => $post]) }}" class="btn btn-primary">Edit post</a>
                    </div>
                @endcan

                @can('delete', $post)
                    <form method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete post</button>
                    </form>
                @endcan

                <div>
                    <a href="{{ route('profile.show', ['profile' => $post->user->profile]) }}">{{ $post->user->name }}</a>
                    <span>{{ $post->created_at->format('j F Y H:i') }}</span>
                    <span>{{ $post->city }}</span>

                    @isset($weather)
                        <img src="https://openweathermap.org/img/wn/{{ $weather['icon'] }}@2x.png" alt="{{ $weather['description'] }}">
                        <span>{{ $weather['description'] }}</span>
                        <span class="font-weight-bold">{{ $weather['temperature'] }}&deg;C</span>
                    @else
                        <span>No weather information to display</span>
                    @endisset
                </div>

                @isset($post->image)
                    <img class="img-fluid" src="{{ asset($post->image) }}" alt="{{ $post->title }}">
                @endisset

                <p>{{ $post->body }}</p>

                <comments-section :post="{{ $post }}" @auth :user="{{ Auth::user() }}" @endauth></comments-section>
            </div>
        </div>
    </div>
@endsection
