<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>
    <div class="container mx-auto">
        <form method="POST" wire:submit.prevent="" >
            <div>
                <label for="name" >{{ __('Name') }}</label>
                <input id="name" class="block mt-1 w-full" type="text" required autofocus autocomplete="name" wire:model="name" readonly/>
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="email" >{{ __('Email') }}</label>
                <input id="email" class="block mt-1 w-full" type="text" required autofocus autocomplete="email" wire:model="email" readonly/>
                @error('email') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="address" >{{ __('Address') }}</label>
                <input id="address" class="block mt-1 w-full" type="text" required autofocus autocomplete="address" wire:model="address" readonly/>
                @error('address') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="city" >{{ __('City') }}</label>
                <input id="city" class="block mt-1 w-full" type="text" required autofocus autocomplete="city" wire:model="city" readonly/>
                @error('city') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="province" >{{ __('Province') }}</label>
                <input id="province" class="block mt-1 w-full" type="text" required autofocus autocomplete="province" wire:model="province" readonly/>
                @error('province') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="postalCode" >{{ __('Postal Code') }}</label>
                <input id="postalCode" class="block mt-1 w-full" type="text" required autofocus autocomplete="postalCode" wire:model="postalCode" readonly/>
                @error('postalCode') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="phone" >{{ __('Phone') }}</label>
                <input id="phone" class="block mt-1 w-full" type="text" required autofocus autocomplete="phone" wire:model="phone" readonly/>
                @error('phone') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="onlyShippingLabel" >{{ __('Shipping Label Only') }}</label>
                <input id="onlyShippingLabel" class="block mt-1 w-full" type="text" required autofocus autocomplete="onlyShippingLabel" wire:model="onlyShippingLabel" readonly/>
                @error('onlyShippingLabel') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="paymentMethod" >{{ __('Payment Method') }}</label>
                <input id="paymentMethod" class="block mt-1 w-full" type="text" required autofocus autocomplete="paymentMethod" wire:model="paymentMethod" readonly/>
                @error('paymentMethod') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="paymentEmail" >{{ __('Payment Email') }}</label>
                <input id="paymentEmail" class="block mt-1 w-full" type="text" required autofocus autocomplete="paymentEmail" wire:model="paymentEmail" readonly/>
                @error('paymentEmail') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-end mt-4">
                <button class="ml-4">
                    {{ __('Print') }}
                </button>
            </div>

        </form>
    </div>

</div>
