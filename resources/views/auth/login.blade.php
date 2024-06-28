@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="container mx-auto mt-8 max-w-md">
        <h2 class="text-2xl font-semibold mb-4">Login</h2>
        <form id="loginForm" class="space-y-4">
            @csrf
            <div class="form-group">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <div class="form-group">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <button type="submit" class="btn btn-primary mt-4 w-full bg-blue-500 text-white py-2 rounded-md">Login</button>
        </form>
    </div>
@endsection

@section('scripts')
    @include('layouts.partials.scripts.login-scripts')
@endsection
