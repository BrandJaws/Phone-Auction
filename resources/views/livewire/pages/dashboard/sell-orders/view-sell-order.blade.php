<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight adminHeading">
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

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <div class="sellerInfo">
                        <form method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" wire:submit.prevent="" >

                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"  for="fName" >{{ __('First Name') }}</label>
                                    <input id="fName"  class="appearance-none block w-full bg-gray-200 text-gray-700 border-2 border-gray-200 rounded py-2 px-4 leading-tight"  type="text" required autocomplete="name" wire:model="firstName" readonly/>
                                    @error('firstName') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"  for="lName" >{{ __('Last name') }}</label>
                                    <input id="lName"  class="appearance-none block w-full bg-gray-200 text-gray-700 border-2 border-gray-200 rounded py-2 px-4 leading-tight"  type="text" required autocomplete="email" wire:model="lastName" readonly/>
                                    @error('lastName') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="flex flex-wrap -mx-3 mb-6">
                                <!-- <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"  for="name" >{{ __('Name') }}</label>
                                    <input id="name"  class="appearance-none block w-full bg-gray-200 text-gray-700 border-2 border-gray-200 rounded py-2 px-4 leading-tight"  type="text" required autocomplete="name" wire:model="name" readonly/>
                                    @error('name') <span class="error">{{ $message }}</span> @enderror
                                </div> -->
                                <div class="w-full md:w-2/2 px-3 mb-6 md:mb-0">
                                    <label  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"  for="email" >{{ __('Email') }}</label>
                                    <input id="email"  class="appearance-none block w-full bg-gray-200 text-gray-700 border-2 border-gray-200 rounded py-2 px-4 leading-tight"  type="text" required autocomplete="email" wire:model="email" readonly/>
                                    @error('email') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"  for="address" >{{ __('Address') }}</label>
                                    <input id="address"  class="appearance-none block w-full bg-gray-200 text-gray-700 border-2 border-gray-200 rounded py-2 px-4 leading-tight"  type="text" required autocomplete="address" wire:model="address" readonly/>
                                    @error('address') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"  for="city" >{{ __('City') }}</label>
                                    <input id="city"  class="appearance-none block w-full bg-gray-200 text-gray-700 border-2 border-gray-200 rounded py-2 px-4 leading-tight"  type="text" required autocomplete="city" wire:model="city" readonly/>
                                    @error('city') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"  for="province" >{{ __('Province') }}</label>
                                    <input id="province"  class="appearance-none block w-full bg-gray-200 text-gray-700 border-2 border-gray-200 rounded py-2 px-4 leading-tight"  type="text" required autocomplete="province" wire:model="province" readonly/>
                                    @error('province') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"  for="postalCode" >{{ __('Postal Code') }}</label>
                                    <input id="postalCode"  class="appearance-none block w-full bg-gray-200 text-gray-700 border-2 border-gray-200 rounded py-2 px-4 leading-tight"  type="text" required autocomplete="postalCode" wire:model="postalCode" readonly/>
                                    @error('postalCode') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"  for="phone" >{{ __('Phone') }}</label>
                                    <input id="phone"  class="appearance-none block w-full bg-gray-200 text-gray-700 border-2 border-gray-200 rounded py-2 px-4 leading-tight"  type="text" required autocomplete="phone" wire:model="phone" readonly/>
                                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"  for="onlyShippingLabel" >{{ __('Shipping Label Only') }}</label>
                                    <input id="onlyShippingLabel"  class="appearance-none block w-full bg-gray-200 text-gray-700 border-2 border-gray-200 rounded py-2 px-4 leading-tight"  type="text" required autocomplete="onlyShippingLabel" wire:model="onlyShippingLabel" readonly/>
                                    @error('onlyShippingLabel') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"  for="paymentMethod" >{{ __('Payment Method') }}</label>
                                    <input id="paymentMethod"  class="appearance-none block w-full bg-gray-200 text-gray-700 border-2 border-gray-200 rounded py-2 px-4 leading-tight"  type="text" required autocomplete="paymentMethod" wire:model="paymentMethod" readonly/>
                                    @error('paymentMethod') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"  for="paymentEmail" >{{ __('Payment Email') }}</label>
                                    <input id="paymentEmail"  class="appearance-none block w-full bg-gray-200 text-gray-700 border-2 border-gray-200 rounded py-2 px-4 leading-tight"  type="text" required autocomplete="paymentEmail" wire:model="paymentEmail" readonly/>
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

                <div  class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <div  class="sellerTotalInfo">
                        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                            <div class="card">
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Total</span>
                                <span class="totalPrice">
                                    $1400
                                </span>
                            </div>
                            <div class="sellerList">
                                <ul>
                                    <li>
                                        <span class="deviceName">
                                            Galaxy S10+ 512GB/1TB / Rogers /<br> <span class="deviceCondition"> Like New </span>
                                        </span>
                                        <span class="devicePrice">
                                            $790.00
                                        </span>
                                    </li>
                                    <li>
                                        <span class="deviceName">
                                            Galaxy S8+ 512GB/1TB / Rogers /<br> <span class="deviceCondition"> Like New </span>
                                        </span>
                                        <span class="devicePrice">
                                            $610.00
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>



            
        </div>
    </div>

</div>
