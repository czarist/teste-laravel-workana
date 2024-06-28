@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container mx-auto mt-4">
        <h2 class="text-2xl font-semibold mb-4">Home</h2>
        <ul class="list-group space-y-2">
            @foreach ($users as $user)
                <li class="list-group-item bg-white shadow-md rounded-md p-4 flex justify-between items-center">
                    <div>
                        <span class="font-medium">{{ $user->name }}</span>
                        <span class="text-gray-600">({{ $user->email }})</span>
                    </div>
                    <button data-id="{{ $user->id }}" class="view-details-btn btn btn-primary">
                        <i class="fas fa-eye"></i>
                    </button>
                </li>
            @endforeach
        </ul>
    </div>

    <div id="userModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full relative">
            <h2 class="text-xl font-semibold mb-4">User Details</h2>
            <div id="userDetails">
                <!-- User details will be loaded here -->
            </div>
            <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
@endsection

@section('scripts')
    @include('layouts.partials.scripts.home-scripts')
@endsection
