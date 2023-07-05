<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Alerty
        </h2>
    </x-slot>
    <x-page-layout>
        <div>
            <a class="btn btn-primary" href="{{ route('alerts.create') }}">Dodaj alert</a>
            <hr class="mt-3">
            <div class="mt-3">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tytuł</th>
                        <th>Kategoria</th>
                        <th>Obszar powiadamiania</th>
                        <th>Ważny od</th>
                        <th>Ważny do</th>
                        <th>Akcje</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($alerts as $alert)
                        <tr>
                            <td>{{$alert->id}}</td>
                            <td>{{$alert->title}}</td>
                            <td>{{$alert->category->name}}</td>
                            <td>{{$alert_types[$alert->area->type]}}</td>
                            <td>{{str_replace(' 00:00:00', '',$alert->valid_from)}}</td>
                            <td>{{str_replace(' 00:00:00', '',$alert->valid_to)}}</td>
                            <td>
                                <a class="btn btn-secondary mb-2" href="{{ route('alerts.show', $alert) }}">Zobacz</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </x-page-layout>
</x-app-layout>
