<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        Password::sendResetLink($this->only('email'));

        session()->flash('status', __('A reset link will be sent if the account exists.'));
    }
}; ?>

<!-- Main Centering Container -->
<div class="flex min-h-full flex-1 flex-col justify-center py-12 sm:px-6 lg:px-8 bg-gray-50 h-screen">
    
    <!-- Centered Header & Logo -->
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <div class="flex items-center justify-center gap-2 mb-6">
            <div class="bg-[#16a34a] text-white p-2 rounded-lg flex items-center justify-center shadow-sm">
                <i class="fa-solid fa-leaf text-xl"></i>
            </div>
            <span class="text-3xl font-bold text-[#1e3a8a] tracking-tight">Mavuno</span>
        </div>
        <h2 class="text-2xl font-bold leading-9 tracking-tight text-slate-900">
            Forgot password?
        </h2>
        <p class="mt-2 text-sm text-slate-500">
            Enter your email to receive a password reset link
        </p>
    </div>

    <!-- Centered Card -->
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-[480px]">
        <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12 border border-gray-100">
            
            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

            <form method="POST" wire:submit="sendPasswordResetLink" class="space-y-6">
                <!-- Email Address -->
                <flux:input
                    wire:model="email"
                    :label="__('Email Address')"
                    type="email"
                    required
                    autofocus
                    placeholder="manager@teafactory.co.ke"
                    class="focus:!border-[#1e3a8a] focus:!ring-[#1e3a8a]/20"
                />

                <div class="pt-2">
                    <flux:button 
                        variant="primary" 
                        type="submit" 
                        class="flex w-full justify-center !bg-[#1e3a8a] hover:!bg-[#1e3a8a]/90 !border-[#1e3a8a] !text-white font-bold shadow-sm transition-all py-2" 
                        data-test="email-password-reset-link-button"
                    >
                        {{ __('Email password reset link') }}
                    </flux:button>
                </div>
            </form>

            <div class="mt-6 text-center text-sm text-slate-500">
                <span>{{ __('Or, return to') }}</span>
                <flux:link :href="route('login')" wire:navigate class="font-semibold !text-[#16a34a] hover:text-[#16a34a]/80 ml-1">
                    {{ __('log in') }}
                </flux:link>
            </div>
        </div>
    </div>
</div>