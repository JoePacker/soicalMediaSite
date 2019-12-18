@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-3">
                <img class="img-fluid rounded-circle mb-3" src="{{ asset($profile->image) }}" alt="{{ $profile->user->name }}" width="128">

                <h1>{{ $profile->user->name }}</h1>

                @isset($profile->bio)
                    <p>{{ $profile->bio }}</p>
                @endisset

                @can('update', $profile)
                    <div>
                        <a href="{{ route('profile.edit', ['profile' => $profile]) }}" class="btn btn-primary">Edit profile</a>
                    </div>
                @endcan
            </div>
            <div class="col-md-9">
                <h2>Posts</h2>

                <div class="container-fluid">
                    <div class="row">
                        @forelse($posts as $post)
                            <div class="col-md-4 mb-4">
                                <div class="card">
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
                        @empty
                            <p>There are no posts to display.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
