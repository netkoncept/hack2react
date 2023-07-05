<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a class="text-blue-600 hover:text-blue-800" href="{{ route('alerts.index') }}">Alerty</a>
            \ Podgląd: {{ $alert->title }}
        </h2>
    </x-slot>
    <x-page-layout>
        <div>
            <h1 class="h2">{{$alert->title}}</h1>
            <p>{{$alert->description}}</p>
            <p>Kategoria: {{$alert->category->name}}</p>
            <p>Ważne od: {{str_replace(' 00:00:00', '',$alert->valid_from)}}</p>
            <p>Ważne od: {{str_replace(' 00:00:00', '',$alert->valid_to)}}</p>
            @if($alert->area->type < 3)
                <p>Obszar powiadamiania: Obszar na mapie</p>
                <div id="map" class="w-full" style="height: 300px;"></div>
            @else
                <p>Obszar powiadamiania: Adres</p>
                @if($alert->area->cords[0]->teryt_commune === null)
                    <p>Wszystkie gminy</p>
                @else
                    <p>Gmina: {{\App\Services\Teryt::commune($alert->area->cords[0]->teryt_commune)['name']}}</p>
                @endif
                @if($alert->area->cords[0]->teryt_city === null)
                    <p>Wszystkie miejscowości</p>
                @else
                    <p>Miejscowość: {{\App\Services\Teryt::city($alert->area->cords[0]->teryt_city)['name']}}</p>
                @endif
                @if($alert->area->cords[0]->teryt_street === null)
                    <p>Wszystkie ulice</p>
                @else
                    <p>Ulica: {{$alert->area->cords[0]->teryt_street}}</p>
                    <p>Ulica: {{\App\Services\Teryt::street($alert->area->cords[0]->teryt_street)['name']}}</p>
                @endif
            @endif
        </div>
    </x-page-layout>

    @section('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css">
    @endsection

    @section('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>
        @if($alert->area->type === 1)
            <script>
                const type = 1;
                const cords = {
                    lat: {{$alert->area->cords[0]->lat}},
                    lng: {{$alert->area->cords[0]->lng}},
                };
                const radius = {{$alert->area->cords[1]->lat}};
            </script>
        @endif
        @if($alert->area->type === 2)
            <script>
                const type = 2;
                const cords = {!!json_encode($alert->area->cords) !!};
            </script>
        @endif
        <script src="{{ url('js/alert-show.js') }}"></script>
    @endsection

</x-app-layout>
