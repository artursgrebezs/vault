<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts.admin')] #[Title('Dashboard')] class extends Component
{
    //
};
?>

<div class="space-y-6">
    <div>
        <flux:heading size="xl" level="1">{{ __('Dashboard') }}</flux:heading>
        <flux:text class="mt-2 text-zinc-600 dark:text-zinc-400">
            {{ __('Welcome, :name.', ['name' => auth()->user()->name]) }}
        </flux:text>
    </div>

    <flux:separator variant="subtle" />

    <flux:callout variant="secondary" icon="information-circle" heading="{{ __('Admin panel') }}">
        {{ __('This is the main area. Add sections to the sidebar as you build features.') }}
    </flux:callout>
</div>
