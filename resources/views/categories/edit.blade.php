<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a class="text-blue-600 hover:text-blue-800" href="{{ route('categories.index') }}">Kategorie</a>
            \ Edytuj kategorię: {{ $category->name }}
        </h2>
    </x-slot>

    <x-page-layout>

        <form method="POST" action="{{ route('categories.update', $category) }}">
            @csrf
            @method('PUT')
            <div>
                <x-label for="name" value="Nazwa"/>
                <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                         :value="old('name' ,$category->name)" required autofocus autocomplete="name"/>
                <x-input-error for="name"/>
            </div>
            <div class="mt-4">
                <x-checkbox id="force_localization" class="form-check-input"
                            :checked="old('force_localization',$category->force_localization)"
                            :disabled="false"
                            name="force_localization">
                    Wymuś lokalizację użytkownika
                </x-checkbox>
                <x-input-error for="force_localization"/>
            </div>
            <div class="mt-4">
                <x-checkbox id="citizen" class="form-check-input"
                            :checked="old('citizen',$category->citizen)"
                            :disabled="false"
                            name="citizen">
                    Wysyłaj do mieszkańców
                </x-checkbox>
                <x-input-error for="citizen"/>
            </div>
            <div class="mt-4">
                <x-checkbox id="tourist" class="form-check-input"
                            :checked="old('tourist',$category->tourist)"
                            :disabled="false"
                            name="tourist">
                    Wysyłaj do turystów
                </x-checkbox>
                <x-input-error for="tourist"/>
            </div>

            <input type="hidden" name="id" value="{{ $category->id }}">

            <div class="flex items-center justify-end mt-4">
                <button class="btn btn-primary" style="background-color: #0d6efd;" type="submit">Zapisz</button>
            </div>
        </form>
    </x-page-layout>
</x-app-layout>
