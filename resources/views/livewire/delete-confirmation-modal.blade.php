<a wire:click.prevent="show" href class="text-red-600 hover:text-red-900">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
    </svg>
</a>

<!-- Delete Confirmation Modal -->
<x-jet-dialog-modal wire:model="showing">
    <x-slot name="title">
        {{ __('Delete Category') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Are you sure you want to delete the category? Once the category is deleted, all of the posts contains the category will be permanently deleted.') }}
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click.prevent="hide" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-2" wire:click.prevent="delete" wire:loading.attr="disabled">
            {{ __('Delete Category') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>
