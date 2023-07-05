<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a class="text-blue-600 hover:text-blue-800" href="{{ route('users.index') }}">{{ __('users.header') }}</a>
            \ {{ __('users.edit.header') }}: {{ $user->name }}
        </h2>
    </x-slot>

<x-page-layout>

    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PUT')
        <div>
            <x-label for="name" value="{{ __('users.table.name') }}"/>
            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                         :value="old('name', $user->name)" required autofocus autocomplete="name"/>
            <x-input-error for="name" />
        </div>

        <div class="mt-4">
            <x-label for="email" value="{{ __('users.table.email') }}"/>
            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                         :value="old('email', $user->email)" required/>
            <x-input-error for="email" />
        </div>

        <div class="mt-4">
            <x-label for="password" value="{{ __('Password') }}"/>
            <x-input id="password" class="block mt-1 w-full" type="password" name="password"/>
            <x-input-error for="password" />
        </div>

        <div class="mt-4">
            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}"/>
            <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                         name="password_confirmation"/>
        </div>

        <input type="hidden" name="id" value="{{ $user->id }}">

        <div class="flex items-center justify-end mt-4">
            <button class="btn btn-primary" style="background-color: #0d6efd;" type="submit">Zapisz</button>
        </div>
    </form>
</x-page-layout>
</x-app-layout>
