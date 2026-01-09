<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\URL;

new class extends Component {
    public $company;

    public function mount($company): void
    {
        $this->company = $company;
    }

    public function selectCompany(): void
    {
        // Set the active company in the session
        session(['company_id' => $this->company->id]);

        // Redirect back to the previous page to reflect changes
        $this->redirect(URL::previous(), navigate: true);
    }
}; ?>

<flux:menu.item wire:click="selectCompany" class="cursor-pointer group">
    <div class="flex items-center gap-2.5">
        <div class="flex items-center justify-center size-6 rounded-md bg-gray-100 text-gray-500 dark:bg-white/10 dark:text-zinc-400 group-hover:bg-[#1e3a8a]/10 group-hover:text-[#1e3a8a] dark:group-hover:bg-[#1e3a8a] dark:group-hover:text-white transition-colors">
            <i class="fa-solid fa-building text-xs"></i>
        </div>
        <span class="font-medium text-gray-700 dark:text-zinc-200 group-hover:text-[#1e3a8a] dark:group-hover:text-white">{{ $company->name }}</span>
    </div>
</flux:menu.item>