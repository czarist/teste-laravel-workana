@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
    <div class="container mx-auto mt-8 max-w-md">
        <h2 class="text-2xl font-semibold mb-4">Forgot Password</h2>
        <form id="resetForm" class="space-y-4">
            @csrf
            <div class="form-group">
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" id="email" name="email"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <button type="submit" class="btn btn-primary mt-4 w-full bg-blue-500 text-white py-2 rounded-md">Send Password
                Reset Link</button>
            <div id="loadingSpinner" class="text-center mt-4 hidden">
                <svg class="animate-spin h-5 w-5 text-blue-500 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                    </circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    @include('layouts.partials.scripts.email-scripts')
@endsection
