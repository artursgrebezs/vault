<?php

use Livewire\Component;

new class extends Component
{
    public int $count = 0;

    public function increment(): void
    {
        $this->count++;
    }
};
?>

<div class="rounded-lg border border-zinc-200 bg-white p-4 shadow-sm">
    <h2 class="text-lg font-semibold">Livewire</h2>
    <p class="mt-2 text-zinc-600">Count: <span class="font-mono font-bold">{{ $count }}</span></p>
    <button
        type="button"
        wire:click="increment"
        class="mt-3 rounded-md bg-zinc-900 px-3 py-1.5 text-sm text-white hover:bg-zinc-800"
    >
        +1
    </button>
</div>
