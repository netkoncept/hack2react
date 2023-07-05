<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Użytkownicy
        </h2>
    </x-slot>
    <x-page-layout>
        <div>
            <a class="btn btn-primary" href="{{ route('users.create') }}">Dodaj użytkownika</a>
            <hr class="mt-3">
            <div class="mt-3">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nazwa</th>
                        <th>Email</th>
                        <th>2FA</th>
                        <th>Akcje</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if($user->two_factor_confirmed_at)
                                    Tak
                                @else
                                    Nie
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-secondary mb-2" href="{{ route('users.edit', $user) }}">Edytuj</a>

                                <form action="{{ route('users.destroy', $user) }}" method="POST">
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
                {{ $users->links() }}
            </div>
        </div>

    </x-page-layout>
</x-app-layout>
