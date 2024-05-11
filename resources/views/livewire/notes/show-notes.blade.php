<?php

use Livewire\Volt\Component;

new class extends Component {
    public function with(): array
    {
        return [
            'notes' => Auth::user()
                ->notes()
                ->orderBy('send_date', 'asc')
                ->get()        ];
    }
}; ?>

<div class="space-y-2">
    @if($notes->isEmpty())
        <div class="text-center">
            <p class="text-xl font-bold">No notes yet</p>
            <p class="text-sm mb-6">Let's create your fitst note to send</p>
            <x-button primary icon-right="plus">Create Note</x-button>
        </div>

    @else
        <div class="grid grid-cols-2 gap-2">
            @foreach($notes as $note)
            <x-card wire:key='{{ $note->id }}'>
                <div class="flex justify-between">
                    <a href="#">
                        {{ $note->title }}
                    </a>
                    <div class="text-xs text-gray-500">
                        {{ \Carbon\Carbon::parse($note->send_date)->format('M-d-y') }}
                    </div>
                </div>
                <div class="flex items-end justify-between mt-4 space-x-1">
                    <p class="text-xs">Recipient: <span class="font-semibold">{{ $note->recipient }}</span> </p>

                    <div>
                        <x-button.circle icon="eye" />
                        <x-button.circle icon="trash" />
                    </div>
                
                </div>
            </x-card>
            @endforeach
        </div>
    @endif


   
</div>
