<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Profile') }}
        </h2>
    </x-slot>
    <?php
        $connect = mysqli_connect('homestead.test', 'root', 'secret', 'homestead');
        $user = mysqli_query($connect, "select * from users where id='$id'");
        $user = mysqli_fetch_array($user);
    ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <x-auth-validation-success class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('admin.profile.update')}}">
                        @method('PUT')
                        @csrf
                        <div>
                                <input type='hidden', id='id', name='id', value="{{ $id }}">
                                <div class='mt-4'>
                                    <x-label for="name" :value="__('Name')" />
                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $user['name'] }}" autofocus />
                                </div>
                                <div class='mt-4'>
                                    <x-label for="email" :value="__('Email')" />
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $user['email'] }}" autofocus />
                                </div>
                                <div class='mt-4'>
                                    <x-label for="dob" :value="__('Ngay sinh')" />
                                    <x-input id="dob" class="block mt-1 w-full" type="date" name="dob" value="{{ $user['dob'] }}" autofocus />
                                </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>