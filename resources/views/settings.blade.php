<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ustawienia
        </h2>
    </x-slot>
    <x-page-layout>
        <h3>Moduły:</h3>
        <div class="form-check mt-2">
            <x-input id="item1" class="form-check-input" type="checkbox" name="tourist" checked/>
            <x-label for="item1"  class="form-check-label" value="Moduł powiadomień"/>
        </div>
        <div class="form-check mt-2">
            <x-input id="item2" class="form-check-input" type="checkbox" name="tourist" checked/>
            <x-label for="item2"  class="form-check-label" value="Moduł zgłoszeń mieszkańców"/>
        </div>
        <div class="form-check mt-2">
            <x-input id="item3" class="form-check-input" type="checkbox" name="tourist"/>
            <x-label for="item3"  class="form-check-label" value="Moduł aktualności"/>
        </div>
        <div class="form-check mt-2">
            <x-input id="item4" class="form-check-input" type="checkbox" name="tourist"/>
            <x-label for="item4"  class="form-check-label" value="Moduł wydarzeń"/>
        </div>

        <div class="form-check mt-2 mb-4">
            <x-input id="item6" class="form-check-input" type="checkbox" name="tourist"/>
            <x-label for="item6"  class="form-check-label" value="Moduł integracji zewnętrznej"/>
        </div>

        <button class="btn btn-primary mb-4">Zapisz</button>

        <hr class="mb-4">

        <h3>Adresy do powiadomień e-mail:</h3>
        <x-label for="item5"  class="form-check-label mt-2" value="Wprowadź adres e-mail"/>
        <x-input id="item5" class="w-full" type="email" name="tourist" placeholder="wprowadź adres e-mail"/>
        <button class="btn btn-primary mt-2 mb-4">Dodaj</button>

        <h3>Dodane adresy:</h3>
        <ul class="mt-2 list-disc ml-4">
            <li>test@example.com <a class="text-danger" href="#" onclick="return confirm('Na pewno usunąć?')">Usuń</a> </li>
            <li>test@example.com <a class="text-danger" href="#" onclick="return confirm('Na pewno usunąć?')">Usuń</a> </li>
            <li>test@example.com <a class="text-danger" href="#" onclick="return confirm('Na pewno usunąć?')">Usuń</a> </li>
            <li>test@example.com <a class="text-danger" href="#" onclick="return confirm('Na pewno usunąć?')">Usuń</a> </li>
            <li>test@example.com <a class="text-danger" href="#" onclick="return confirm('Na pewno usunąć?')">Usuń</a> </li>
            <li>test@example.com <a class="text-danger" href="#" onclick="return confirm('Na pewno usunąć?')">Usuń</a> </li>
            <li>test@example.com <a class="text-danger" href="#" onclick="return confirm('Na pewno usunąć?')">Usuń</a> </li>
        </ul>

    </x-page-layout>
</x-app-layout>
