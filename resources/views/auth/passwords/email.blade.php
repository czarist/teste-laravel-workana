@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <div class="container">
        <h2>Reset Password</h2>
        <form id="resetForm">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
        </form>
    </div>
@endsection

@section('scripts')
    @include('layouts.partials.scripts.reset-scripts')
@endsection
