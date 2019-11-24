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

                <h1>{{ $profile->user->name }}</h1>

                @isset($profile->image)
                    <img class="img-fluid" src="{{ asset($profile->image) }}" alt="{{ $profile->user->name }}">
                @endisset

                @isset($profile->bio)
                    <p>{{ $profile->bio }}</p>
                @endisset
            </div>
        </div>
    </div>
@endsection
