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
        </form>
    </div>
@endsection

@section('scripts')
    @include('layouts.partials.scripts.email-scripts')
@endsection
