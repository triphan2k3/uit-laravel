<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create user') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{route('users.store')}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row g-3">
                            <!-- Name input -->
                            <div class="col-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            
                            <!-- Role input -->
                            <div class="col-6">
                                <label class="form-label">Role</label>
                                <select class="form-select" name="role">
                                    @if (Auth::user()->role == 'owner')
                                        <option value="owner">owner</option>
                                    @endif
                                    <option value="admin">admin</option>
                                    <option value="user" selected>user</option>
                                </select>
                            </div>
                            <!-- Email input -->
                            <div class="col-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="" name="email">
                            </div>

                            <!-- Date of birth input -->
                            <div class="col-6">
                                <label class="form-label">Date of birth</label>
                                <input type="date" class="form-control" value="" name="date_of_birth">
                            </div>

                            <h3>Security</h3>
                            
                            <!-- New password -->
                            @if (Auth::user()->role == 'owner' || Auth::user()->role == 'admin')
                                <div class="col-6">
                                    <label class="form-label">New password</label>
                                    <input type="text" class="form-control" value="" name="new_password">
                                    <div class="form-text">If you don't want to change password, leave this blank.</div>
                                </div>
                            @else
                                <div class="col-6">
                                    <label class="form-label">New password</label>
                                    <input type="password" class="form-control" value="" name="new_password">
                                    <div class="form-text">If you don't want to change password, leave this blank.</div>
                                </div>
                            <!-- Confirm new password -->
                                <div class="col-6">
                                    <label class="form-label">Confirm new password</label>
                                    <input type="password" class="form-control" value="" name="confirm_new_password">
                                </div>  
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Create</button>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>