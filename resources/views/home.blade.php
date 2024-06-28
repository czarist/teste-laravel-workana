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
            </div>
            <div class="flex justify-end space-x-4 mt-4">
                <button id="editUser" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</button>
                <button id="deleteUser" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
            </div>
            <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editUserModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full relative">
            <h2 class="text-xl font-semibold mb-4">Edit User</h2>
            <form id="editUserForm">
                @csrf
                <input type="hidden" id="editUserId">
                <div class="mb-2">
                    <label for="editName" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="editName" name="name"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-2">
                    <label for="editEmail" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="editEmail" name="email"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-2">
                    <label for="editCep" class="block text-sm font-medium text-gray-700">CEP</label>
                    <input type="text" id="editCep" name="cep" maxlength="9"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-2">
                    <label for="editStreet" class="block text-sm font-medium text-gray-700">Street</label>
                    <input type="text" id="editStreet" name="street"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-2">
                    <label for="editNumber" class="block text-sm font-medium text-gray-700">Number</label>
                    <input type="text" id="editNumber" name="number"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-2">
                    <label for="editCity" class="block text-sm font-medium text-gray-700">City</label>
                    <input type="text" id="editCity" name="city"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-2">
                    <label for="editState" class="block text-sm font-medium text-gray-700">State</label>
                    <input type="text" id="editState" name="state"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                <div class="mb-2">
                    <label for="editCountry" class="block text-sm font-medium text-gray-700">Country</label>
                    <input type="text" id="editCountry" name="country"
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm" readonly required>
                </div>
                <div class="flex justify-end space-x-4 mt-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" id="closeEditModal" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
            <button id="closeEditUserModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
@endsection

@section('scripts')
    @include('layouts.partials.scripts.home-scripts')
@endsection
