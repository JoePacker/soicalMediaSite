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

                <div class="row">
                    <div class="col-md-9">
                        <h1>{{ $post->title }}</h1>
                    </div>
                    <div class="col-md-3">
                        <div class="float-right">
                            @can('update', $post)
                                <a href="{{ route('posts.edit', ['post' => $post]) }}" class="btn btn-primary">Edit</a>
                            @endcan

                            @can('delete', $post)
                                <form method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>

                <ul class="list-inline">
                    <li class="list-inline-item">
                        <span>Posted by </span>
                        <a href="{{ route('profile.show', ['profile' => $post->user->profile]) }}">{{ $post->user->name }}</a>
                        <span>on {{ $post->created_at->format('j F Y H:i') }}</span>
                    </li>
                    <li class="list-inline-item">City:</li>
                    <li class="list-inline-item text-muted">{{ $post->city }}</li>
                    <li class="list-inline-item">Weather:</li>
                    <li class="list-inline-item text-muted">
                        @isset($weather)
                            <span>{{ $weather['description'] }}</span>
                            <img src="https://openweathermap.org/img/wn/{{ $weather['icon'] }}.png" alt="{{ $weather['description'] }}">
                            <span>{{ $weather['temperature'] }}&deg;C</span>
                        @else
                            <span class="mb-2">No weather information to display</span>
                        @endisset
                    </li>
                </ul>

                @isset($post->image)
                    <img class="img-fluid w-100 rounded mb-4" src="{{ asset($post->image) }}" alt="{{ $post->title }}">
                @endisset

                <div class="row">
                    <div class="col-md-10">
                        <p>{{ $post->body }}</p>
                    </div>
                </div>

                <comments-section :post="{{ $post }}" @auth :user="{{ Auth::user() }}" @endauth></comments-section>
            </div>
        </div>
    </div>
@endsection
