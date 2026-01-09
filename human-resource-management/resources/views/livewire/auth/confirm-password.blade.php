<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $password = '';

    /**
     * Confirm the current user's password.
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
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
            Confirm password
        </h2>
        <p class="mt-2 text-sm text-slate-500">
            This is a secure area. Please confirm your password before continuing.
        </p>
    </div>

    <!-- Centered Card -->
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-[480px]">
        <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12 border border-gray-100">
            
            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

            <form method="POST" wire:submit="confirmPassword" class="space-y-6">
                <!-- Password -->
                <flux:input
                    wire:model="password"
                    :label="__('Password')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Password')"
                    viewable
                    class="focus:!border-[#1e3a8a] focus:!ring-[#1e3a8a]/20"
                />

                <div class="pt-2">
                    <flux:button 
                        variant="primary" 
                        type="submit" 
                        class="flex w-full justify-center !bg-[#1e3a8a] hover:!bg-[#1e3a8a]/90 !border-[#1e3a8a] !text-white font-bold shadow-sm transition-all py-2" 
                        data-test="confirm-password-button"
                    >
                        {{ __('Confirm') }}
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</div>