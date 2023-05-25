<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User downloaded files
        </h2>
    </x-slot>

    <div>
        @livewire('user-files')
    </div>
</x-app-layout>
