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

                <img class="img-fluid" src="{{ asset($profile->image) }}" alt="{{ $profile->user->name }}">

                @isset($profile->bio)
                    <p>{{ $profile->bio }}</p>
                @endisset

                @can('update', $profile)
                    <div>
                        <a href="{{ route('profile.edit', ['profile' => $profile]) }}" class="btn btn-primary">Edit profile</a>
                    </div>
                @endcan
            </div>
        </div>
    </div>
@endsection
