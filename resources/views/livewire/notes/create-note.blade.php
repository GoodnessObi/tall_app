<?php

use Livewire\Volt\Component;

new class extends Component {
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;


    public function submit()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:20'],
            'noteRecipient' => ['required', 'email'],
            'noteSendDate' => ['required', 'date']
        ]);

        auth()->user()->notes()->create([
            'title' => $this->noteTitle,
            'body' => $this->noteBody,
            'recipient' => $this->noteRecipient,
            'send_date' => $this->noteSendDate,
            'is_published' => false
        ]);

        redirect(route('notes.index'));
    }
}; ?>

<div>
    <form wire:submit="submit" class="space-y-4">
        <x-input label="Note Title" wire:model="noteTitle" placeholder="Enter Title" />

        <x-textarea  label="Your Note" wire:model="noteBody" placeholder="Share all your thoughts to your friend" />

        <x-input label="Recipient" wire:model="noteRecipient" placeholder="yourfirnd@email.com" type='email' icon="user" />

        <x-input label="Send Date" wire:model="noteSendDate" type="date" icon="calendar" />

        <div class="pt-4">
            <x-button primary label="Schedule Note" wire:click="submit" right-icon="calendar" spinner />

        </div>
    </form>
</div>
