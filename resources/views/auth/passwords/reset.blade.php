@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <div class="container mx-auto mt-8 max-w-md">
        <h2 class="text-2xl font-semibold mb-4">Reset Password</h2>
        <form id="resetPasswordForm" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $_GET['email'] }}">
            <div class="form-group">
                <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                <input type="email" disabled class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    value="{{ $_GET['email'] }}">
            </div>
            <div class="form-group">
                <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input type="password" id="password" name="password"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New
                    Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <button type="submit" class="btn btn-primary mt-4 w-full bg-blue-500 text-white py-2 rounded-md">Reset
                Password</button>
        </form>
    </div>
@endsection

@section('scripts')
    @include('layouts.partials.scripts.reset-scripts')
@endsection
