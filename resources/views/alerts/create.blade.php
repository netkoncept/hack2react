<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Alerty
        </h2>
    </x-slot>

    <x-page-layout>

        <form method="POST" action="{{ route('alerts.store') }}">

            <div>
                <x-label for="title" value="Tytuł"/>
                <x-input id="title" name="title" class="block mt-1 w-full" type="text" :value="old('title')"
                         required/>
                <x-input-error for="title"/>
            </div>

            <div>
                <x-label for="description" value="Opis"/>
                <x-textarea id="description" name="description" class="block mt-1 w-full">
                    {{ old('description') }}
                </x-textarea>
                <x-input-error for="description"/>
            </div>

            <div>
                <x-label for="category_id" value="Kategoria"/>
                <x-select name="category_id" id="category_id">
                    <option value="0" selected>Wybierz kategorię</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-select>
            </div>

            <div>
                <x-label for="alert-area-type" value="Obszar powiadamiania"/>
                <x-select name="alert-area-type" id="alert-area-type">
                    <option value="0" selected>Obszar na mapie</option>
                    <option value="1">Adres</option>
                </x-select>
            </div>

            <div id="area-on-map">
                <div id="map" class="mt-1 w-full" style="height: 300px;"></div>
                <x-input-error for="area-lat-lngs"/>
            </div>

            <div id="address-from-teryt">

                <div>
                    <x-label for="teryt-commune" value="Gmina"/>
                    <x-select name="teryt-commune" id="teryt-commune">
                        <option value="" selected disabled>Wszystkie gminy</option>
                        @foreach($communes as $commune)
                            <option value="{{ $commune['code'] }}">{{ $commune['name'] }}</option>
                        @endforeach
                    </x-select>
                </div>

                <div>
                    <x-label for="teryt-city" value="Miejscowość"/>
                    <x-select name="teryt-city" id="teryt-city" disabled>
                        <option value="" selected disabled>Wszystkie miejscowości</option>
                    </x-select>
                </div>

                <div>
                    <x-label for="teryt-street" value="Ulica"/>
                    <x-select name="teryt-street" id="teryt-street" disabled>
                        <option value="" selected disabled>Wszystkie ulice</option>
                    </x-select>
                </div>

            </div>

            <div>
                <x-label for="valid_from" value="Ważny od"/>
                <x-input id="valid_from" name="valid_from" class="block mt-1 w-full" type="date"
                         :value="old('valid_from')"
                         required/>
                <x-input-error for="valid_from"/>
            </div>

            <div>
                <x-label for="valid_to" value="Ważny do"/>
                <x-input id="valid_to" name="valid_to" class="block mt-1 w-full" type="date"
                         :value="old('valid_to')"
                         required/>
                <x-input-error for="valid_to"/>
            </div>

            @csrf
            <input type="hidden" id="area-type" name="area-type">
            <input type="hidden" id="area-lat-lngs" name="area-lat-lngs">
            <input type="hidden" id="area-radius" name="area-radius">

            <div class="flex items-center justify-end mt-4">
                <button class="btn btn-primary" style="background-color: #0D6EFD;" type="submit">
                    Dodaj alert
                </button>
            </div>

        </form>

    </x-page-layout>

    @section('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css">
    @endsection

    @section('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>
        <script src="{{ url('js/alert-form.js') }}"></script>
    @endsection

</x-app-layout>


