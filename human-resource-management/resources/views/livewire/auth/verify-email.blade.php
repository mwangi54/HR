<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::check()) {
            Auth::user()->sendEmailVerificationNotification();
            Session::flash('status', 'verification-link-sent');
        }
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }

    /**
     * Handle the component's rendering hook.
     */
    public function rendering(View $view): void
    {
        // Check if user is authenticated and has verified email
        if (Auth::check() && Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
            return;
        }
    }

    /**
     * Get the user's verification status
     */
    public function with(): array
    {
        return [
            'verified' => Auth::check() ? Auth::user()->hasVerifiedEmail() : false,
        ];
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
        <h1 class="text-xl font-semibold text-slate-800">{{ __('Verify email') }}</h1>
        <p class="text-sm text-slate-500 mt-1">
            {{ __('Please verify your email address by clicking on the link we just emailed to you.') }}
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="bg-green-50 border border-green-200 text-[#16a34a] px-4 py-3 rounded-md text-sm text-center">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="flex flex-col gap-4">
        <button 
            wire:click="sendVerification" 
            type="button"
            class="w-full bg-[#1e3a8a] hover:bg-[#1e3a8a]/90 border border-[#1e3a8a] text-white font-medium py-2 px-4 rounded-md shadow-sm transition-all"
        >
            {{ __('Resend verification email') }}
        </button>

        <div class="text-center">
            <button 
                class="text-sm cursor-pointer text-[#1e3a8a] font-medium hover:underline bg-transparent border-none" 
                wire:click="logout" 
                data-test="logout-button"
            >
                {{ __('Log out') }}
            </button>
        </div>
    </div>
</div>