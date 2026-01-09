<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Locked]
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Mount the component.
     */
    public function mount(string $token): void
    {
        $this->token = $token;

        $this->email = request()->string('email');
    }

    /**
     * Reset the password for the given user.
     */
    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status !== Password::PASSWORD_RESET) {
            $this->addError('email', __($status));

            return;
        }

        Session::flash('status', __($status));

        $this->redirectRoute('login', navigate: true);
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
        <h1 class="text-xl font-semibold text-slate-800">{{ __('Reset password') }}</h1>
        <p class="text-sm text-slate-500 mt-1">{{ __('Please enter your new password below') }}</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form method="POST" wire:submit="resetPassword" class="flex flex-col gap-5">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email')"
            type="email"
            required
            autocomplete="email"
            class="focus:!border-[#1e3a8a] focus:!ring-[#1e3a8a]/20"
        />

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Password')"
            type="password"
            required