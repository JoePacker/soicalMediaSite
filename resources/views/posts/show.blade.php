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

                <comments-section :post="{{ $post }}" @can('create', 'App\Comment') :can-add-comment="true" @endcan/>
            </div>
        </div>
    </div>
@endsection
