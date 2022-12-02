<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (Auth::user()->name == $user->name)
                {{ __('Edit your profile') }}
            @else
                {{ __('Edit '.$user->name."'s".' profile') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('users.update', $user->id)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <!-- Name input -->
                            <div class="col-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" value="{{$user->name}}" name="name">
                            </div>
                            
                            <!-- Role input -->
                            <div class="col-6">
                                <label class="form-label">Role</label>
                                <select class="form-select" name="role">
                                    @if (Auth::user()->role == 'owner')
                                        <option value="owner" {{$user->role == "owner" ? 'selected' : ''}} >owner</option>
                                    @endif
                                    <option value="admin" {{$user->role == "admin" ? 'selected' : ''}} >admin</option>
                                    <option value="user" {{$user->role == "user" ? 'selected' : ''}} >user</option>
                                </select>
                            </div>
                            <!-- Email input -->
                            <div class="col-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{$user->email}}" name="email">
                            </div>

                            <!-- Date of birth input -->
                            <div class="col-6">
                                <label class="form-label">Date of birth</label>
                                <input type="date" class="form-control" value="{{$user->date_of_birth}}" name="date_of_birth">
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

                            <!-- Old password confirm -->
                            @if (Auth::user()->role == 'user')
                                <div class="col-6">
                                    <label class="form-label">Current password</label>
                                    <input type="password" class="form-control" value="" name="password">
                                </div>
                            @endif

                        </div>
                        <button type="submit" class="btn btn-success mt-2">Update</button>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>