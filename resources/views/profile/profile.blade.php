@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if(Auth::user()->profile_image)
                            <img src="{{ asset('storage/profile_pics/' . Auth::user()->profile_image) }}" alt="User Profile Image" class="img-thumbnail">
                            @else
                            <p>No profile image uploaded.</p>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <strong>Name:</strong> {{ Auth::user()->name }}<br>
                            <strong>Email:</strong> {{ Auth::user()->email }}<br>
                            <br>
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
