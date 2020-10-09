<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>
    <div class="container mx-auto">
        <form method="POST" wire:submit.prevent="save" >
            <div>
                <label for="deviceState" >{{ __('Device State') }}</label>
                <select name="deviceState" wire:model="device_state_id">
                    <option value="">Select a device state</option>
                    @foreach ($deviceStates as $deviceState)
                        <option value="{{ $deviceState->id }}" {{  $device_state_id === $deviceState->id ? 'selected' : '' }}>{{ $deviceState->condition }}</option>
                    @endforeach
                </select>
                @error('device_state_id') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="networkCarrier" >{{ __('Network Carrier') }}</label>
                <select name="networkCarrier" wire:model="network_carrier_id">
                    <option value="">Select a network Carrier</option>
                    @foreach ($networkCarriers as $networkCarrier)
                        <option data-test="{{ $network_carrier_id .'-' .$networkCarrier->id  }}" value="{{ $networkCarrier->id }}" {{ $network_carrier_id === $networkCarrier->id ? 'selected' : '' }}>{{ $networkCarrier->name }}</option>
                    @endforeach
                </select>
                @error('network_carrier_id') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <label for="quote_price" >{{ __('Quote Price') }}</label>
                <input id="quote_price" class="block mt-1 w-full" type="number" wire:model="quote_price"/>
                @error('quote_price') <span class="error">{{ $message }}</span> @enderror
            </div>


            <div class="flex items-center justify-end mt-4">
                <button class="ml-4">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
    </div>

</div>
