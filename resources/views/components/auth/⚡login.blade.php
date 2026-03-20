<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts.guest')] #[Title('Log in')] class extends Component
{
    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', __('These credentials do not match our records.'));

            return;
        }

        // Use session() helper so Livewire tests and subrequests work (request()->session() may be unset).
        session()->regenerate();

        $user = Auth::user();
        if (! $user->hasRole('super-admin')) {
            Auth::logout();
            $this->addError('email', __('You are not authorized to access the admin panel.'));

            return;
        }

        $this->redirectIntended(route('dashboard', absolute: false), true);
    }
};
?>

<div class="w-full max-w-sm">
    <flux:heading size="xl" level="1" class="mb-1">{{ __('Sign in') }}</flux:heading>
    <flux:text class="mb-6 text-zinc-600 dark:text-zinc-400">{{ config('app.name') }}</flux:text>

    <form
        wire:submit="login"
        method="post"
        action="{{ url('/login') }}"
        class="space-y-6 rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-900"
    >
        @csrf
        <flux:field>
            <flux:label>{{ __('Email') }}</flux:label>
            <flux:input wire:model="email" type="email" autocomplete="username" required />
            <flux:error name="email" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Password') }}</flux:label>
            <flux:input wire:model="password" type="password" autocomplete="current-password" required />
            <flux:error name="password" />
        </flux:field>

        <flux:field variant="inline">
            <flux:checkbox wire:model="remember" label="{{ __('Remember me') }}" />
        </flux:field>

        <flux:button type="submit" variant="primary" class="w-full" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="login">{{ __('Sign in') }}</span>
            <span wire:loading wire:target="login">{{ __('Signing in…') }}</span>
        </flux:button>
    </form>
</div>
