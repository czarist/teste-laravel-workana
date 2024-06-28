@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-semibold mb-4">Register</h2>
        <form id="registerForm" class="space-y-4">
            @csrf
            <div class="form-group">
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" id="name" name="name"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
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
            <div class="form-group">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <div class="form-group">
                <label for="cep" class="block text-sm font-medium text-gray-700">CEP</label>
                <input type="text" id="cep" name="cep" maxlength="9"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <div class="form-group">
                <label for="street" class="block text-sm font-medium text-gray-700">Street</label>
                <input type="text" id="street" name="street"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" readonly>
            </div>
            <div class="form-group">
                <label for="number" class="block text-sm font-medium text-gray-700">Number</label>
                <input type="text" id="number" name="number"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <div class="form-group">
                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                <input type="text" id="city" name="city"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" readonly>
            </div>
            <div class="form-group">
                <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                <input type="text" id="state" name="state"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" readonly>
            </div>
            <div class="form-group">
                <label for="countryHidden" class="block text-sm font-medium text-gray-700">Country</label>
                <input disabled type="text" id="countryHidden" name="countryHidden"
                    class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <input type="hidden" id="country" name="country" class="form-control" required>

            <button type="submit"
                class="btn btn-primary mt-4 w-full bg-blue-500 text-white py-2 rounded-md">Register</button>
        </form>
    </div>
@endsection

@section('scripts')
    @include('layouts.partials.scripts.register-scripts')
@endsection
