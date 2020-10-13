<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>
    <x-slot name="headerBtn">
        &nbsp;
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:pb-0">
        <div class="boxPanel py-6 px-6 bg-white rounded-lg mt-10">

            <div class="panelHeading mb-5">
                <h2 class="font-semibold text-xl text-black leading-tight">
                Sell Orders Info
                </h2>
            </div>
            <form method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" wire:submit.prevent="" >

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="name" >{{ __('Name') }}</label>
                        <input id="name" class="block mt-1 w-full" type="text" required autofocus autocomplete="name" wire:model="name" readonly/>
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="email" >{{ __('Email') }}</label>
                        <input id="email" class="block mt-1 w-full" type="text" required autofocus autocomplete="email" wire:model="email" readonly/>
                        @error('email') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="address" >{{ __('Address') }}</label>
                        <input id="address" class="block mt-1 w-full" type="text" required autofocus autocomplete="address" wire:model="address" readonly/>
                        @error('address') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="city" >{{ __('City') }}</label>
                        <input id="city" class="block mt-1 w-full" type="text" required autofocus autocomplete="city" wire:model="city" readonly/>
                        @error('city') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="province" >{{ __('Province') }}</label>
                        <input id="province" class="block mt-1 w-full" type="text" required autofocus autocomplete="province" wire:model="province" readonly/>
                        @error('province') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="postalCode" >{{ __('Postal Code') }}</label>
                        <input id="postalCode" class="block mt-1 w-full" type="text" required autofocus autocomplete="postalCode" wire:model="postalCode" readonly/>
                        @error('postalCode') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="phone" >{{ __('Phone') }}</label>
                        <input id="phone" class="block mt-1 w-full" type="text" required autofocus autocomplete="phone" wire:model="phone" readonly/>
                        @error('phone') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="onlyShippingLabel" >{{ __('Shipping Label Only') }}</label>
                        <input id="onlyShippingLabel" class="block mt-1 w-full" type="text" required autofocus autocomplete="onlyShippingLabel" wire:model="onlyShippingLabel" readonly/>
                        @error('onlyShippingLabel') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="paymentMethod" >{{ __('Payment Method') }}</label>
                        <input id="paymentMethod" class="block mt-1 w-full" type="text" required autofocus autocomplete="paymentMethod" wire:model="paymentMethod" readonly/>
                        @error('paymentMethod') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="paymentEmail" >{{ __('Payment Email') }}</label>
                        <input id="paymentEmail" class="block mt-1 w-full" type="text" required autofocus autocomplete="paymentEmail" wire:model="paymentEmail" readonly/>
                        @error('paymentEmail') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Print') }}
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
