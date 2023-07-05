<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kategorie alertów
        </h2>
    </x-slot>
    <x-page-layout>
        <div>
            <a class="btn btn-primary" href="{{ route('categories.create') }}">Dodaj kategorię</a>
            <hr class="mt-3">
            <div class="mt-3">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nazwa</th>
                        <th>Można wymusić lokalizację</th>
                        <th>Dla mieszkańca</th>
                        <th>Dla turysty</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>
                                @if($category->force_localization)
                                    Tak
                                @else
                                    Nie
                                @endif
                            </td>                            <td>
                                @if($category->citizen)
                                    Tak
                                @else
                                    Nie
                                @endif
                            </td>                            <td>
                                @if($category->tourist)
                                    Tak
                                @else
                                    Nie
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-secondary mb-2" href="{{ route('categories.edit', $category) }}">Edytuj</a>

                                <form action="{{ route('categories.destroy', $category) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" style="background-color: #dc3545;" type="submit"
                                            onclick="return confirm('Na pewno usunąć?')">Usun
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $categories->links() }}
            </div>
        </div>

    </x-page-layout>
</x-app-layout>
