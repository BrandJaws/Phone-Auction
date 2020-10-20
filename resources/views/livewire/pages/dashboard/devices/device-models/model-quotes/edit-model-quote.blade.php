<div>
    <x-slot name="header">
        <h1 class="font-semibold text-3xl text-gray-800 leading-tight adminHeading">
            {{ $title }}
        </h1>
    </x-slot>
    <x-slot name="headerBtn">
        &nbsp;
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:pb-20">
        <div class="boxPanel py-6 px-6 bg-white rounded-lg mt-10">
            <div class="panelHeading mb-5">
                <h2 class="font-semibold text-xl text-black leading-tight">
                    Modal Quote
                </h2>
            </div>

            <form method="POST"  class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" wire:submit.prevent="save" >
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="deviceState">
                        {{ __('Device State') }}
                        </label>
                        <select
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border-2 border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                            name="deviceState" wire:model="device_state_id">
                                <option value="">Select a device state</option>
                                @foreach ($deviceStates as $deviceState)
                                    <option value="{{ $deviceState->id }}" >{{ $deviceState->condition }}</option>
                                @endforeach
                            </select>
                            @error('device_state_id') <span class="error error text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="networkCarrier" >
                            {{ __('Network Carrier') }}
                        </label>
                        <select
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border-2 border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                        name="networkCarrier" wire:model="network_carrier_id">
                            <option value="0">Select a network carrier</option>
                            @foreach ($networkCarriers as $networkCarrier)
                                <option value="{{ $networkCarrier->id }}" >{{ $networkCarrier->name }}</option>
                            @endforeach
                        </select>
                        @error('network_carrier_id') <span class="error text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <label for="quote_price" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >{{ __('Quote Price') }}</label>
                    <input id="quote_price" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="number" wire:model="quote_price"/>
                    @error('quote_price') <span class="error error text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Save') }}
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
