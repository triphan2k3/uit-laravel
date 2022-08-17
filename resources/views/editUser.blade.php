@if (Auth::user()->role == 'user' || Auth::user()->role == 'admin' && $user->role == 'owner')
<x-app-layout>
        <x-slot name="header">
            <div class="alert alert-danger">You have no permission to access this site!</div>
        </x-slot>
</x-app-layout>
@else
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

                            <!-- Role input -->
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                @if (Auth::user()->role == 'user')
                                    <input class="form-control" type="text" placeholder="{{$user->role}}" disabled>

                                @elseif (Auth::user()->role == 'admin')
                                    @if ($user->role == 'owner')
                                        <input class="form-control" type="text" placeholder="owner" disabled>
                                    @else
                                        <select class="form-select" name="role">
                                            <option value="admin" {{$user->role == "admin" ? 'selected' : ''}} >admin</option>
                                            <option value="user" {{$user->role == "user" ? 'selected' : ''}} >user</option>
                                        </select>
                                    @endif

                                @else
                                    <select class="form-select" name="role">
                                        <option value="owner" {{$user->role == "owner" ? 'selected' : ''}} >owner</option>
                                        <option value="admin" {{$user->role == "admin" ? 'selected' : ''}} >admin</option>
                                        <option value="user" {{$user->role == "user" ? 'selected' : ''}} >user</option>
                                    </select>
                                @endif
                            </div>
                            
                            <!-- Name input -->
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" value="{{$user->name}}" name="name">
                            </div>

                            <!-- Email input -->
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{$user->email}}" name="email">
                            </div>

                            <!-- Date of birth input -->
                            <div class="mb-3">
                                <label class="form-label">Date of birth</label>
                                <input type="date" class="form-control" value="{{$user->date_of_birth}}" name="date_of_birth">
                            </div>
                            <button type="submit" class="btn btn-success mt-2">Update</button>    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif