<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Statystyki
        </h2>
    </x-slot>
    <x-page-layout>
        <div class="overflow-hidden grid grid-cols-3 gap-2 justify-between">
            <x-card link="#"
                    text="Alerty"
                    subText="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin dapibus erat sapien, sed dapibus urna sodales gravida. Suspendisse vitae orci ac est auctor pharetra ut venenatis nibh."/>
            <x-card link="#"
                    text="Urządzenia"
                    subText="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin dapibus erat sapien, sed dapibus urna sodales gravida. Suspendisse vitae orci ac est auctor pharetra ut venenatis nibh."/>
            <x-card link="#"
                    text="Zgłoszenia mieszkańców"
                    subText="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin dapibus erat sapien, sed dapibus urna sodales gravida. Suspendisse vitae orci ac est auctor pharetra ut venenatis nibh."/>
            <x-card link="#"
                    text="Uzytkownicy"
                    subText="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin dapibus erat sapien, sed dapibus urna sodales gravida. Suspendisse vitae orci ac est auctor pharetra ut venenatis nibh."/>
        </div>

    </x-page-layout>
</x-app-layout>
