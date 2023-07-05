<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a class="text-blue-600 hover:text-blue-800" href="{{ route('categories.index') }}">Kategorie</a>
            \ Dodaj kategorię
        </h2>
    </x-slot>

    <x-page-layout>
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf
            <div>
                <x-label for="name" value="Nazwa"/>
                <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                         :value="old('name')" required autofocus autocomplete="name"/>
                <x-input-error for="name" />
            </div>

            <div class="mt-4">
                <div class="form-check">
                    <x-input id="force_localization" class="form-check-input" type="checkbox" name="force_localization"/>
                    <x-label for="force_localization"  class="form-check-label" value="Wymuś lokalizację użytkownika"/>
                </div>
                <x-input-error for="force_localization" />
            </div>
            <div class="mt-4">
                <div class="form-check">
                    <x-input id="citizen" class="form-check-input" type="checkbox" name="citizen"/>
                    <x-label for="citizen"  class="form-check-label" value="Wysyłaj do mieszkańców"/>
                </div>
                <x-input-error for="citizen" />
            </div>
            <div class="mt-4">
                <div class="form-check">
                    <x-input id="tourist" class="form-check-input" type="checkbox" name="tourist"/>
                    <x-label for="tourist"  class="form-check-label" value="Wysyłaj do turystów"/>
                </div>
                <x-input-error for="tourist" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button class="btn btn-primary" style="background-color: #0d6efd;" type="submit">Dodaj kategorię</button>
            </div>
        </form>
    </x-page-layout>
</x-app-layout>
