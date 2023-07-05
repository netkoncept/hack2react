<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Urządzenia
        </h2>
    </x-slot>
    <x-page-layout>
        <div>
            <div class="mt-3">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>UUID</th>
                        <th>System</th>
                        <th>Wersja</th>
                        <th>Model</th>
                        <th>Zezwala na lokalizację</th>
                        <th>Kim jest</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($devices as $device)
                        <tr>
                            <td>{{$device->uuid}}</td>
                            <td>{{$device->os}}</td>
                            <td>{{$device->os_version}}</td>
                            <td>{{$device->model}}</td>
                            <td>
                                @if ($device->can_force_localization)
                                    Tak
                                @else
                                    Nie
                                @endif
                            </td>
                            <td>
                                @if($device->citizen && $device->tourist)
                                    Mieszkaniec <br>Turysta
                                @elseif($device->citizen && !$device->tourist)
                                    Mieszkaniec
                                @elseif(!$device->citizen && $device->tourist)
                                    Turysta
                                @else
                                    ---
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $devices->links() }}
            </div>
        </div>
    </x-page-layout>
</x-app-layout>
