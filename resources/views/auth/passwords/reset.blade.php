@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <div class="container">
        <h2>Reset Password</h2>
        <form id="resetPasswordForm">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $_GET['email'] }}">
            <div class="form-group">
                <label for="password">E-mail</label>
                <input type="email" disabled class="form-control" value="{{ $_GET['email'] }}">
            </div>
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>
    </div>
@endsection

@section('scripts')
    @include('layouts.partials.scripts.reset-scripts')
@endsection
