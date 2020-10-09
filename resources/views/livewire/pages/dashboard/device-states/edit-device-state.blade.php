<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>
    <div class="container mx-auto">
        <form method="POST" wire:submit.prevent="save" >
            <div>
                <label for="condition" >{{ __('Condition') }}</label>
                <input id="condition" class="block mt-1 w-full" type="text" required autofocus autocomplete="condition" wire:model="condition"/>
                @error('condition') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <label for="features" >{{ __('Features') }}</label>
                <button wire:click.prevent="addFeature">+</button>
                @foreach ($features as $featureIndex => $feature)
                    <div>
                        <input id="features.{{$featureIndex}}" class="block mt-1 w-full" type="text" wire:model="features.{{$featureIndex}}"/>
                        <button wire:click.prevent="removeFeature({{$featureIndex}})">-</button>
                    </div>
                @endforeach
                @error('features') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-end mt-4">
                <button class="ml-4">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
    </div>

</div>
