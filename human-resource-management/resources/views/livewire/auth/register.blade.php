<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6 w-full max-w-sm mx-auto min-h-screen justify-center py-12">
    <div class="text-center mb-4">
        <div class="flex items-center justify-center gap-2 mb-4">
            <div class="bg-[#16a34a] text-white p-1.5 rounded-lg flex items-center justify-center">
                <i class="fa-solid fa-leaf text-lg"></i>
            </div>
            <span class="text-2xl font-bold text-[#1e3a8a] tracking-tight">Mavuno</span>
        </div>
        <h1 class="text-xl font-semibold text-slate-800">{{ __('Create a factory account') }}</h1>
        <p class="text-sm text-slate-500 mt-1">{{ __('Initialize a new admin profile for your tea factory') }}</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form method="POST" wire:submit="register" class="flex flex-col gap-5">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Full Name')"
            type="text"
            required
            autofocus
            autocomplete="name"
            placeholder="John Doe"
            class="focus:!border-[#1e3a8a] focus:!ring-[#1e3a8a]/20"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email address')"
            type="email"
            required
            autocomplete="email"
            placeholder="manager@teafactory.co.ke"
            class="focus:!border-[#1e3a8a] focus:!ring-[#1e3a8a]/20"
        />

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Password')"
            type="password"
            required
            autocomplete="new-password"
            placeholder="Minimum 8 characters"
            viewable
            class="focus:!border-[#1e3a8a] focus:!ring-[#1e3a8a]/20"
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Confirm Password')"
            type="password"
            required
            autocomplete="new-password"
            placeholder="Re-enter password"
            class="focus:!border-[#1e3a8a] focus:!ring-[#1e3a8a]/20"
        />

        <div class="pt-2">
            <flux:button 
                variant="primary" 
                type="submit" 
                class="w-full !bg-[#1e3a8a] hover:!bg-[#1e3a8a]/90 !border-[#1e3a8a] !text-white font-medium shadow-sm transition-all"
                data-test="register-user-button"
            >
                {{ __('Create Account') }}
            </flux:button>
        </div>
    </form>

    <div class="text-center text-sm text-zinc-500">
        <span>{{ __('Already have an account?') }}</span>
        <flux:link :href="route('login')" wire:navigate class="!text-[#16a34a] font-semibold hover:!text-[#16a34a]/80 ml-1">
            {{ __('Sign in to portal') }}
        </flux:link>
    </div>
</div>