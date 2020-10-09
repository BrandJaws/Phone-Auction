<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>
    <div class="container mx-auto">
        <form method="POST" wire:submit.prevent="save" >
            <div>
                <label for="name" >{{ __('Name') }}</label>
                <input id="name" class="block mt-1 w-full" type="text" required autofocus autocomplete="name" wire:model="name"/>
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <label for="image" >{{ __('Image') }}</label>
                <input id="image" class="block mt-1 w-full" type="file" wire:model="image"/>
                @error('image') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-end mt-4">
                <button class="ml-4">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
    </div>

</div>
