<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a class="text-blue-600 hover:text-blue-800" href="{{ route('users.index') }}">Użytkownicy</a>
            \ Dodaj użytkwonika
        </h2>
    </x-slot>

    <x-page-layout>
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div>
                <x-label for="name" value="{{ __('users.table.name') }}"/>
                <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                         :value="old('name')" required autofocus autocomplete="name"/>
                <x-input-error for="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('users.table.email') }}"/>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                         :value="old('email')" required/>
                <x-input-error for="email" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}"/>
                <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                         required autocomplete="new-password"/>
                <x-input-error for="password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation">Potwierdzenie hasła</x-label>
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                         name="password_confirmation" required autocomplete="new-password"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button class="btn btn-primary" style="background-color: #0d6efd;" type="submit">Dodaj użytkownika</button>
            </div>
        </form>
    </x-page-layout>
</x-app-layout>
