<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create A Note') }}
        </h2>
    </x-slot>

    @php
        $notes = App\Models\Note::all()->where('user_id', Auth::user()->id);
    @endphp

    <div class="py-12">
        <div class="max-w-2xl mx-auto space-y-8 sm:px-6 lg:px-8">
            <x-button icon="arrow-left" href="{{route('notes.index')}}">All Notes</x-button>
            <livewire:notes.create-note />
        </div>
    </div>
</x-app-layout>
