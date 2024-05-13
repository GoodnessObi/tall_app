<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create A Note') }}
        </h2>
    </x-slot>

    @php
        $notes = App\Models\Note::all()->where('user_id', Auth::user()->id);
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:notes.create-note />
        </div>
    </div>
</x-app-layout>
