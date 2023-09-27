@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1>Welcome to the To-Do List App</h1>
            <p>Your personal task manager. Manage all your tasks efficiently and never miss a deadline!</p>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>


        </div>
    </div>
</div>
@endsection
