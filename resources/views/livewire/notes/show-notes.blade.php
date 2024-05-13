<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {

    public function delete($noteId)
    {
        $note = Note::where('id', $noteId)->first();
        $note->delete();
    }

    public function with(): array
    {
        return [
            'notes' => Auth::user()
                ->notes()
                ->orderBy('send_date', 'asc')
                ->get()
            ];
    }
}; ?>

<div class="space-y-2">
    @if($notes->isEmpty())
        <div class="text-center">
            <p class="text-xl font-bold">No notes yet</p>
            <p class="mb-6 text-sm">Let's create your fitst note to send</p>
            <x-button primary icon-right="plus" href="{{route('notes.create')}}" wire:navigate>Create Note</x-button>
        </div>

    @else
        <div class="flex justify-end mb-8">
            <x-button primary icon-right="plus" href="{{route('notes.create')}}" wire:navigate>Create Note</x-button>
        </div>

        <div class="grid grid-cols-3 gap-2">
            @foreach($notes as $note)
            <x-card wire:key='{{ $note->id }}'>
                <div class="flex justify-between">
                    <a href="#" class="space-y-4">
                        {{ $note->title }}

                        <p class="text-xs">{{ Str::limit($note->body, 50 )}}</p>
                    </a>
                    <div class="text-xs text-gray-500 text-nowrap">
                        {{ \Carbon\Carbon::parse($note->send_date)->format('M-d-y') }}
                    </div>
                </div>
                <div class="flex items-end justify-between mt-4 space-x-1">
                    <p class="text-xs">Recipient: <span class="font-semibold">{{ $note->recipient }}</span> </p>

                    <div>
                        <x-button.circle icon="eye" />
                        <x-button.circle icon="trash" wire:click="delete('{{ $note->id }}')" />
                    </div>
                </div>

            </x-card>
            @endforeach
        </div>
    @endif



</div>

