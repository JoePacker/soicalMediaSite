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

                @foreach ($posts as $post)
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('posts.show', ['post' => $post]) }}">{{ $post->title }}</a>
                        </div>
                        <div class="card-body">
                            <p>{{ $post->body }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
