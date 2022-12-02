<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Successfully edit or delete messeges -->
                    @if (Session::has('noti'))
                        <div class="alert alert-success">
                            {{Session::get('noti')}}
                        </div>
                    @endif

                    <form class="row g-3" action="{{route('users.index')}}" method="GET">
                        @csrf
                        <div class="col-auto">
                            <input type="text" class="form-control" placeholder="..." name="search">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary mb-3">Search</button>
                        </div>
                    </form>
                    {{$users->links()}}
                    <table class="table table-hover" style="table-layout: auto;">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 5%">ID</th>
                                <th style="width: 15%">Role</th>
                                <th style="width: 15%">Name</th>
                                <th style="width: 20%">Date of birth</th>
                                <th style="width: 30%">Email</th>
                                <th style="width: 15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->role }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->date_of_birth }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>
                                        <form action="{{route('users.destroy', $value->id)}}" method="POST">
                                        @can('update', $value)
                                            <!-- Edit button -->
                                            <a href="{{ route('users.edit', $value) }}" style="text-decoration: none"><button type="button" class="btn btn-success">Edit</button></a>
                                        @endcan
                                        @can('delete', $value)
                                            @csrf
                                            @method('DELETE')
                                            <!-- Delete button -->
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        @endcan
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>