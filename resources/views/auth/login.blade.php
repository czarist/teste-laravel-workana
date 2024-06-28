@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <h2>Login</h2>
    <form id="loginForm">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
@endsection

@section('scripts')
    @include('layouts.partials.scripts.login-scripts')
@endsection
