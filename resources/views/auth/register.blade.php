@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="container">
        <h2>Register</h2>
        <form id="registerForm">
            @csrf
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                    required>
            </div>
            <div class="form-group">
                <label for="cep">CEP</label>
                <input type="text" id="cep" name="cep" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="street">Street</label>
                <input type="text" id="street" name="street" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="number">Number</label>
                <input type="text" id="number" name="number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="state">State</label>
                <input type="text" id="state" name="state" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <input disabled type="text" id="countryHidden" name="countryHidden" class="form-control" required>
            </div>
            <input type="hidden" id="country" name="country" class="form-control" required>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
@endsection

@section('scripts')
    @include('layouts.partials.scripts.register-scripts')
@endsection
