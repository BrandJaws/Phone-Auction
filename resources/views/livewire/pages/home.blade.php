<div>
    <div class="loaderWrap" wire:loading wire:target="selectDevice, selectDeviceModel, selectNetworkCarrier, selectQuote, addAnotherDevice, displayForm, removeSellOrder, save, selfDropToLocation">
        <div class="loaderBox">
            <img src="{{asset('assets/images/loader.gif')}}">
        </div>
    </div>
    <div class="bg-white">
        <nav class="flex items-center justify-between flex-wrap bg-blue-theme px-6 py-3">
            <div class="homeHeaderLogo">
                <span class="font-semibold text-xl tracking-tight">
                    <a href="http://mobi.retriodev.com/">
                        <img src="{{asset('assets/images/logo-white.png')}}" alt="">
                    </a>
                </span>
            </div>
            <div class="block lg:hidden md:hidden">
                <button class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                </button>
            </div>
            <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto  homeHeaderNav">
                <div class="text-sm lg:flex-grow flex items-center justify-end">
                    <a href="http://mobi.retriodev.com/about-us/" class="block mt-4 lg:inline-block lg:mt-0">
                        About Us
                    </a>
                    <a href="http://mobi.retriodev.com/mobile-phone-repair/" class="block mt-4 lg:inline-block lg:mt-0">
                        Repair
                    </a>
                    <a href="http://mobi.retriodev.com/buy-a-new-phone/" class="block mt-4 lg:inline-block lg:mt-0">
                        Phones
                    </a>
                    <a href="http://mobi.retriodev.com/news/" class="block mt-4 lg:inline-block lg:mt-0">
                        News
                    </a>
                    <a href="http://mobi.retriodev.com/warranty/" class="block mt-4 lg:inline-block lg:mt-0">
                        Warranty
                    </a>
                    <a href="http://mobi.retriodev.com/contact/" class="block mt-4 lg:inline-block lg:mt-0">
                        Directions / Contact Us
                    </a>
                </div>
            </div>
        </nav>
        <section id="addAnotherDevice">
            @if(count($completedSellOrderItems) > 0)
            <div class="addAnotherDeviceWrap">
                <div class="container mx-auto py-12">
                    <div class="grid grid-cols-1 gap-4 text-center">
                        @foreach($sellOrderItems as $index => $sellOrder)
                            @if($sellOrder["completed"])
                                <div class="mainHeading" wire:key="title - {{ $index }}">
                                    <h1 class="text-parrot-100 text-xl float-left">
                                        {{ $sellOrder["selectedDeviceModel"]["name"] }} / {{ $sellOrder["selectedNetworkCarrier"]["name"] }} / {{ $sellOrder["selectedQuote"]["device_state"]["condition"] }}
                                    </h1>
                                    <a  href="#." class="closeBtn" wire:click.prevent="removeSellOrder({{ $index }})">
                                        <svg  wire:key="icon - {{ $index }}" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="30px"
                                        id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="30px" xml:space="preserve"><path d="M437.5,386.6L306.9,256l130.6-130.6c14.1-14.1,14.1-36.8,0-50.9c-14.1-14.1-36.8-14.1-50.9,0L256,205.1L125.4,74.5  c-14.1-14.1-36.8-14.1-50.9,0c-14.1,14.1-14.1,36.8,0,50.9L205.1,256L74.5,386.6c-14.1,14.1-14.1,36.8,0,50.9  c14.1,14.1,36.8,14.1,50.9,0L256,306.9l130.6,130.6c14.1,14.1,36.8,14.1,50.9,0C451.5,423.4,451.5,400.6,437.5,386.6z"/></svg>
                                    </a>
                                </div>
                                <div class="flex flex-wrap mb-6" wire:key="total - {{ $index }}">
                                    <input  class="appearance-none block w-full bg-white-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-200"  type="text" placeholder="Total" value="{{ $sellOrder["selectedQuote"]["quote_price"] }}" readonly/>
                                </div>
                            @endif

                        @endforeach
                        <div class="flex items-center gap-6">
                            <div class="w-full text-center">
                            <button class="shadow mb-0 bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded btnTheme" type="button" wire:click.prevent="addAnotherDevice" {{ !$sellOrderItems[$selectedOrderIndex]["selectedNetworkCarrier"] ? 'disabled' : '' }}>
                                Add Another Device
                            </button>
                            &nbsp;&nbsp;&nbsp;
                            <button class="shadow mb-0 bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded btnTheme" type="button" wire:click="displayForm">
                                Get Paid
                            </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </section>
        <section id="deviceSelectionSection">
            <div class="container mx-auto py-12">
                <div class="grid grid-cols-1 gap-4 text-center pb-10">
                    <div class="mainHeading">
                        <h1><span class="text-parrot-100 mr-2">1.</span> START BY SELECTING YOUR DEVICE BELOW:</h1>
                    </div>
                </div>
                <div class="gap-4">
                    <div class="flex flex-wrap items-center justify-center deviceBoxWrap">
                    @foreach($devices as $device)
                        <div class="w-full sm:w-6/12 md:w-5/12 lg:w-3/12">
                            <a href="#." class="deviceBox text-center"  wire:click.prevent="selectDevice({{$device->id}})">
                                <div class="img-fluid">
                                    <img src="{{$device->image->imageUrl}}" alt="Device" />
                                </div>
                                <div class="imgCaption mt-3">
                                    <p>{{$device->name}}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!--  -->
        @if($sellOrderItems[$selectedOrderIndex]["selectedDevice"])
        <section class="bg-gray-100 block" id="modelSelectionSection">
            <div class="container mx-auto py-12">
                <div class="grid grid-cols-1 gap-4 text-center pb-4">
                    <div class="mainHeading">
                        <span class="subtitleTop">
                            {{ $sellOrderItems[$selectedOrderIndex]["selectedDevice"]["name"] }} / Select your model
                        </span>
                        <h1><span class="text-parrot-100 mr-2">2.</span>SELECT YOUR MODEL:</h1>
                    </div>
                </div>
                <div class="gap-4">
                    <div class="flex flex-wrap items-center justify-center">
                        @foreach($sellOrderItems[$selectedOrderIndex]["selectedDevice"]["models"] as $model)
                            <div class="w-full sm:w-6/12 md:w-3/12 lg:w-2/12 singleDeviceModel" wire:click.prevent="selectDeviceModel({{ $model["id"] }})">
                                <a href="#." class="deviceBox text-center" >
                                    <div class="img-fluid">
                                        <img src="{{$model["image"]["imageUrl"]}}" alt="Device" />
                                    </div>
                                    <div class="imgCaption mt-3">
                                        <p>{{ $model["name"] }}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endif
        <!--  -->
        @if($sellOrderItems[$selectedOrderIndex]["selectedDeviceModel"])
        <section class="bg-white block" id="networkSelectionSection">
            <div class="container mx-auto py-12">
                <div class="grid grid-cols-1 gap-4 text-center pb-4">
                    <div class="mainHeading">
                        <span class="subtitleTop">
                            {{ $sellOrderItems[$selectedOrderIndex]["selectedDevice"]["name"] }} / {{ $sellOrderItems[$selectedOrderIndex]["selectedDeviceModel"]["name"] }} / Select your carrier
                        </span>
                        <h1><span class="text-parrot-100 mr-2">3.</span>SELECT YOUR NETWORK CARRIER:</h1>
                    </div>
                </div>
                <div class="gap-4">
                    <div class="flex flex-wrap items-center justify-center">
                        @foreach($this->networkCarriers as $carrier)
                        <div class="w-full sm:w-6/12 md:w-5/12 lg:w-3/12 networkCarrier" wire:click.prevent="selectNetworkCarrier({{ $carrier->id }})">
                        <a href="#." class="carrierBox text-center {{ $sellOrderItems[$selectedOrderIndex]["selectedNetworkCarrier"] && $sellOrderItems[$selectedOrderIndex]["selectedNetworkCarrier"]["id"] === $carrier->id ? 'active' : '' }}" >
                                <div class="img-fluid">
                                    <img src="{{ $carrier->image->imageUrl}}" alt="Device" />
                                </div>
                            </a>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endif

        @if($sellOrderItems[$selectedOrderIndex]["selectedNetworkCarrier"])
        <section class="bg-gray-100 block" id="quoteSelectionSection">
            <div class="container mx-auto py-12">
                <div class="grid grid-cols-1 gap-4 text-center pb-16">
                    <div class="mainHeading">
                        <h1><span class="text-parrot-100 mr-2">4.</span>STATE OF YOUR DEVICE:</h1>
                    </div>
                </div>
                <div class="flex flex-wrap">
                    <div class="w-3/12">
                        <div class="tabButtons h-full bg-white">
                            @foreach($sellOrderItems[$selectedOrderIndex]["selectedDeviceModel"]["quotes"] as $quote)
                                <a href="#." class="tabBtn {{ $sellOrderItems[$selectedOrderIndex]["selectedQuote"] && $sellOrderItems[$selectedOrderIndex]["selectedQuote"]["id"] === $quote["id"] ? 'active' : '' }}" wire:click="selectQuote({{ $quote["id"] }})" >{{ $quote["device_state"]["condition"] }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="w-9/12">

                        <div class="tabBody p-6 relative h-full col-span-9">
                            <div class="tabContent">
                                <span class="subtitleTop">
                                    {{ $sellOrderItems[$selectedOrderIndex]["selectedDevice"]["name"] }} / {{ $sellOrderItems[$selectedOrderIndex]["selectedDeviceModel"]["name"] }} / {{ $sellOrderItems[$selectedOrderIndex]["selectedNetworkCarrier"]["name"] }}
                                </span>
                                <div class="tabDescription flex">
                                    <ul>
                                        @if($sellOrderItems[$selectedOrderIndex]["selectedQuote"])
                                            @foreach($sellOrderItems[$selectedOrderIndex]["selectedQuote"]["device_state"]["features"] as $feature)
                                                <li>{{ $feature }}</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    <div class="tabRightBox">
                                        @if($sellOrderItems[$selectedOrderIndex]["selectedQuote"])
                                            <div class="price">
                                                <span class="currency">$</span>
                                                <span class="amount">{{
                                                    $sellOrderItems[$selectedOrderIndex]["selectedQuote"]["quote_price_whole"]
                                                }}</span>
                                                <span class="decimalPoint">.{{ $sellOrderItems[$selectedOrderIndex]["selectedQuote"]["quote_price_decimal"] }}</span>
                                            </div>
                                        @endif
                                        <div class="info">
                                            <div class="promoBox">
                                                <input wire:model.lazy="sellOrderItems.{{$selectedOrderIndex}}.promoCode" type="text" placeholder="Enter a promo code*" class="appearance-none block w-full bg-white-200 text-gray-700 border border-red-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white promoInput" autofocus />
                                            </div>
                                            <p>*We occasionally offer promo codes in our email blasts or <a href="#.">Facebook page</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <p><strong>The values are estimates only. Although our estimates are usually accurate, the final value will only be finalized after a physical inspection of your device has been completed by a Mobi Jack’s employee.</strong></p>
                </div>
                <div class="grid grid-flow-col">
                    <div class="buttons">
                        <a href="#." class="btnTheme" wire:click.prevent="addAnotherDevice" >
                            More than one device? Add here
                            {{-- Accept & add another device --}}
                        </a>
                        <a href="#." class="btnTheme btnThemeFill" wire:click="displayForm">
                            Get Paid
                        </a>
                    </div>
                </div>
            </div>
        </section>
        @endif


        @if($sellOrderItems[$selectedOrderIndex]["selectedQuote"] && $formVisible)
        <!--  -->
        <section class="bg-blue-500 block" id="requestFormSection">
            <div class="container mx-auto py-12">
                <div class="flex flex-wrap">
                    <div class="w-7/12">
                            <div class="mainHeading text-left py-8 pt-0">
                                <h1 class="text-white">HOW WOULD YOU LIKE TO DELIVER YOUR DEVICE?</h1>
                                <div class="md:flex md:items-center mb-6">
                                    <label class="md:w-3/3 block text-gray-500 font-bold">
                                    <input name="selfDropToLocation" class="mr-2 leading-tight" type="radio" value="1" wire:model="selfDropToLocation" {{ $selfDropToLocation == '1' ? 'checked' : '' }} >
                                        <span class="text-sm text-white">
                                            Pick a store location
                                            {{-- I will drop my device to a store location --}}
                                        </span>
                                    </label>
                                </div>
                                {{-- <div class="md:flex md:items-center mb-6">
                                    <label class="md:w-3/3 block text-gray-500 font-bold">
                                    <input name="selfDropToLocation" class="mr-2 leading-tight" type="radio" value="0" wire:model="selfDropToLocation" {{ $selfDropToLocation == '0' ? 'checked' : '' }} >
                                        <span class="text-sm text-white">
                                            I will send my device by mail
                                        </span>
                                    </label>
                                </div> --}}
                            </div>
                            <div>
                                <form class="w-full pr-6" wire:submit.prevent="save" method="POST">
                                    @if($selfDropToLocation)
                                        <div>
                                            <div class="flex flex-wrap -mx-3 mb-6">
                                                <div class="w-full px-3">
                                                    <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="email">
                                                        Drop Location
                                                    </label>
                                                    <select class="appearance-none block w-full bg-white-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-200"
                                                            name="deviceState" wire:model.lazy="drop_location_id">
                                                            <option value="">Select a store location</option>
                                                            @foreach ($dropLocations as $dropLocation)
                                                                <option value="{{ $dropLocation->id }}" >{{ $dropLocation->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    @error('drop_location_id') <span class="error">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div>
                                            <div class="mainHeading text-left py-8 pt-0">
                                                <h1 class="text-white">FILL OUT YOUR ADDRESS INFORMATION TO RECEIVE YOUR FREE SHIPPING KIT!</h1>
                                            </div>
                                            <div class="flex flex-wrap -mx-3 mb-6">
                                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                    <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="first-name">
                                                        First Name
                                                    </label>
                                                    <input wire:model.lazy="firstName" class="appearance-none block w-full bg-white-200 text-gray-700 border border-red-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="first-name" type="text" placeholder="Jane" >
                                                    @error('firstName') <span class="error">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="w-full md:w-1/2 px-3">
                                                    <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="last-name">
                                                        Last Name
                                                    </label>
                                                    <input wire:model.lazy="lastName" class="appearance-none mb-3 block w-full bg-white-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-200" id="last-name" type="text" placeholder="Doe">
                                                    @error('lastName') <span class="error">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="flex flex-wrap -mx-3 mb-6">
                                                    <div class="w-full px-3">
                                                        <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="email">
                                                            Email
                                                        </label>
                                                        <input wire:model.lazy="email" class="appearance-none block w-full bg-white-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-200" id="email" type="email" placeholder="johndoe@gmail.com">
                                                        @error('email') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                            </div>

                                            <div class="flex flex-wrap -mx-3 mb-6">
                                                    <div class="w-full px-3">
                                                        <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="street-address">
                                                            Street Address
                                                        </label>
                                                        <input wire:model.lazy="address" class="appearance-none block w-full bg-white-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-200" id="street-address" type="string" placeholder="123 Main St">
                                                        @error('address') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                            </div>

                                            <div class="flex flex-wrap -mx-3 mb-6">
                                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                    <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="city">
                                                        City
                                                    </label>
                                                    <input wire:model.lazy="city" class="appearance-none block w-full bg-white-200 text-gray-700 border border-red-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="city" type="text" placeholder="City">
                                                    @error('city') <span class="error">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="w-full md:w-1/2 px-3">
                                                    <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="province">
                                                        Province
                                                    </label>
                                                    <input wire:model.lazy="province" class="appearance-none block mb-3 w-full bg-white-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-200" id="province" type="text" placeholder="Province">
                                                    @error('province') <span class="error">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="flex flex-wrap -mx-3 mb-6">
                                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                    <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="postal-code">
                                                        Postal Code
                                                    </label>
                                                    <input wire:model.lazy="postalCode" class="appearance-none block mb-3 w-full bg-white-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="postal-code" type="text" placeholder="Postal Code">
                                                    @error('postalCode') <span class="error">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="w-full md:w-1/2 px-3">
                                                    <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="phone-number">
                                                        Phone Number
                                                    </label>
                                                    <input wire:model.lazy="phone" class="appearance-none block mb-3 w-full bg-white-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-200" id="phone-number" type="text" placeholder=" Phone Number">
                                                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="md:flex md:items-center mb-6">
                                                <label class="md:w-3/3 block text-gray-500 font-bold">
                                                <input class="mr-2 leading-tight" type="checkbox" value="1" wire:model.lazy="onlyShippingLabel" {{ $onlyShippingLabel == '1' ? 'checked' : '' }} >
                                                <span class="text-sm text-white">
                                                I only need the shipping label <br>
                                                <span class="text-sm font-normal">Check this box if you already have your own packing box or envelope, and just want us to email you a free shipping label. This will allow you to send us your device faster.</span>
                                                </span>
                                                </label>
                                            </div>

                                            <div class="flex flex-wrap -mx-3 mb-6">
                                                    <div class="w-full px-3">
                                                        <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="street-address">
                                                            Select how you would like to be paid
                                                        </label>

                                                        <div class="flex flex-wrap -mx-3 mb-1">
                                                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                                                <div class="md:flex md:items-center">
                                                                    <label class="block text-gray-500 font-bold radioWithImg">
                                                                    <input class="mr-2 leading-tight h-auto" name="paidCycle" type="radio" value="PAYPAL" wire:model.lazy="paymentMethod" {{ $paymentMethod == 'PAYPAL' ? 'checked' : '' }} >
                                                                    <span class="text-sm text-white radioImgBox">
                                                                        <img src="{{asset('assets/images/paypal.png')}}" alt />
                                                                    </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="w-full md:w-1/3 px-3">
                                                                <div class="md:flex md:items-center">
                                                                    <label class="block text-gray-500 font-bold radioWithImg">
                                                                    <input class="mr-2 leading-tight h-auto" name="paidCycle" type="radio" value="E-TRANSFER" wire:model.lazy="paymentMethod" {{ $paymentMethod == 'E-TRANSFER' ? 'checked' : '' }} >
                                                                    <span class="text-sm text-white radioImgBox">
                                                                        <img src="{{asset('assets/images/interac.svg')}}" alt />
                                                                    </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="w-full md:w-1/3 px-3">
                                                                <div class="md:flex md:items-center">
                                                                    <label class="block text-gray-500 font-bold radioWithImg">
                                                                    <input class="mr-2 leading-tight h-auto" name="paidCycle" type="radio" value="CHEQUE" wire:model.lazy="paymentMethod" {{ $paymentMethod == 'CHEQUE' ? 'checked' : '' }} >
                                                                    <span class="text-sm text-white">
                                                                        Cheque
                                                                    </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="flex flex-wrap -mx-3 mb-6">
                                        <div class="w-full px-3">
                                            <input wire:model.lazy="paymentEmail" class="appearance-none block w-full bg-white-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-200" id="payment-email" type="email" placeholder=" Payment Email*">
                                            @error('paymentEmail') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-white"><strong>The values are estimates only. Although our estimates are usually accurate, the final value will only be finalized after a physical inspection of your device has been completed by a Mobi Jack’s employee.</strong></p>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="w-full text-right flex justify-between items-center">
                                        <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded btnTheme" type="button">
                                            Modify Order
                                        </button>
                                        <input class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded btnTheme" type="submit" value="Submit" />
                                        </div>
                                    </div>
                                </form>
                             </div>
                    </div>
                    <div class="w-5/12">
                        <div class="tabBody  p-6 relative col-span-9 bg-transparent bottomSidebar">
                            <div class="tabContent">

                                <div class="tabDescription">
                                <div  class="sellerTotalInfo">
                                    <div class="">
                                        <div class="card  mb-4">
                                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Total</span>
                                            <div class="tabRightBox border-l-0">
                                                <div class="price">
                                                    <span class="currency">$</span>
                                                    <span class="amount">{{ $netTotalWhole }}</span>
                                                    <span class="decimalPoint">.{{ $netTotalDecimal }}</span>
                                                </div>
                                                {{-- <div class="info">
                                                    <div class="promoBox">
                                                        <input type="text" placeholder="Enter a promo code*" class="appearance-none block w-full bg-white-200 text-gray-700 border border-red-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white promoInput" autofocus />
                                                    </div>
                                                    <p>*We occasionally offer promo codes in our email blasts or <a href="#.">Facebook page</a></p>
                                                </div> --}}
                                            </div>
                                        </div>
                                        <div class="sellerList">
                                            <ul>
                                                @foreach($sellOrderItems as $index => $sellOrder)
                                                    @if($sellOrder["completed"])
                                                    <li wire:key="{{ $index }}">
                                                        <span class="deviceName" wire:key="title - {{ $index }}">
                                                            {{ $sellOrder["selectedDeviceModel"]["name"] }} / {{ $sellOrder["selectedNetworkCarrier"]["name"] }} / <br> <span class="deviceCondition">{{ $sellOrder["selectedQuote"]["device_state"]["condition"] }}</span>
                                                        </span>
                                                        <span class="devicePrice" wire:key="total - {{ $index }}">
                                                            ${{ $sellOrder["selectedQuote"]["quote_price"] }}
                                                        </span>
                                                    </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

    </div>

    {{-- Success Modal --}}

    @if($showSuccessModal)

        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!--
                Background overlay, show/hide based on modal state.

                Entering: "ease-out duration-300"
                    From: "opacity-0"
                    To: "opacity-100"
                Leaving: "ease-in duration-200"
                    From: "opacity-100"
                    To: "opacity-0"
                -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <!-- <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span> -->
                <!--
                Modal panel, show/hide based on modal state.

                Entering: "ease-out duration-300"
                    From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    To: "opacity-100 translate-y-0 sm:scale-100"
                Leaving: "ease-in duration-200"
                    From: "opacity-100 translate-y-0 sm:scale-100"
                    To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-headline">
                                    THANK YOU!
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Your quote request has been submitted. A confirmation email has been sent with your
                                        offer ID to track your order.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <a type="button"
                            href="http://mobi.retriodev.com/"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm btnThemeFill">
                            Go to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>

    @endif

    <script>
        window.livewire.on('scrollToSection',function(sectionId){
            scrollToElement(sectionId);
        })

        function scrollToElement(elementId){
            var element = document.getElementById(elementId);
            if(element){
            // element.scrollIntoView();
                scroll({
                    top: element.offsetTop,
                    behavior: "smooth"
                });
            }
        }


    </script>

</div>
