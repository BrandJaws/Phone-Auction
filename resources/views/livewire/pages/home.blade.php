<div class="bg-white">
    <nav class="flex items-center justify-between flex-wrap bg-blue-theme px-6 py-3">
        <div class="homeHeaderLogo">
            <span class="font-semibold text-xl tracking-tight">
                <img src="{{asset('assets/images/logo-white.png')}}" alt="">
            </span>
        </div>
        <div class="block lg:hidden md:hidden">
            <button class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
            </button>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto  homeHeaderNav">
            <div class="text-sm lg:flex-grow flex items-center justify-end">
                <a href="#." class="block mt-4 lg:inline-block lg:mt-0">
                    About Us
                </a>
                <a href="#." class="block mt-4 lg:inline-block lg:mt-0">
                    Repair
                </a>
                <a href="#." class="block mt-4 lg:inline-block lg:mt-0">
                    Phones
                </a>
                <a href="#." class="block mt-4 lg:inline-block lg:mt-0">
                    News
                </a>
                <a href="#." class="block mt-4 lg:inline-block lg:mt-0">
                    Warranty
                </a>
                <a href="#." class="block mt-4 lg:inline-block lg:mt-0">
                    Directions / Contact Us
                </a>
            </div>
            <a href="#" class="headerBtn inline-block text-sm px-4 mx-6 py-2 leading-none border text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Track My Offer</a>
        </div>
    </nav>
    
    <section>
        <div class="container mx-auto py-12">
            <div class="grid grid-cols-1 gap-4 text-center pb-10">
                <div class="mainHeading">
                    <h1><span class="text-parrot-100 mr-2">1.</span> START BY SELECTING YOUR DEVICE BELOW:</h1>
                </div>
            </div>
            <div class="gap-4">
                <div class="flex flex-wrap items-center justify-center deviceBoxWrap">
                @foreach($devices as $device)
                    <div class="w-2/12">
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
    <section class="bg-gray-100 block">
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
                        <div class="w-2/12">
                            <a href="#." class="deviceBox text-center" wire:click.prevent="selectDeviceModel({{ $model["id"] }})">
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
    <section class="bg-white block">
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
                    <div class="w-3/12">
                        <a href="#." class="carrierBox text-center" wire:click.prevent="selectNetworkCarrier({{ $carrier->id }})">
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
    <section class="bg-gray-100 block">
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
                                        <a href="#." class="btnTheme">
                                            Enter a promo code*
                                        </a>





                                        <p>*We occasionally offer promo codes in our email blasts or <a href="#.">Facebook page</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-flow-col">
                <div class="buttons">
                    <a href="#." class="btnTheme" wire:click.prevent="addAnotherDevice" >
                        Accept & add another device
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
    <section class="bg-blue-500 block">
        <div class="container mx-auto py-12">
            <div class="flex flex-wrap">
                <div class="w-7/12">
                    <div class="mainHeading text-left py-8 pt-0">
                        <h1 class="text-white">FILL OUT YOUR ADDRESS INFORMATION TO RECEIVE YOUR FREE SHIPPING KIT!</h1>
                    </div>

                    <form class="w-full pr-6" wire:submit.prevent="save" method="POST">

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="first-name">
                                    First Name
                                </label>
                                <input wire:model="firstName" class="appearance-none block w-full bg-white-200 text-gray-700 border border-red-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="first-name" type="text" placeholder="Jane" >
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="last-name">
                                    Last Name
                                </label>
                                <input wire:model="lastName" class="appearance-none block w-full bg-white-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-200" id="last-name" type="text" placeholder="Doe">
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="email">
                                        Email
                                    </label>
                                    <input wire:model="email" class="appearance-none block w-full bg-white-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-200" id="email" type="email" placeholder="johndoe@gmail.com">
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="street-address">
                                        Street Address
                                    </label>
                                    <input wire:model="address" class="appearance-none block w-full bg-white-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-200" id="street-address" type="email" placeholder="johndoe@gmail.com">
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="city">
                                    City
                                </label>
                                <input wire:model="city" class="appearance-none block w-full bg-white-200 text-gray-700 border border-red-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="city" type="text" placeholder="City">
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="province">
                                    Province
                                </label>
                                <input wire:model="province" class="appearance-none block w-full bg-white-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-200" id="province" type="text" placeholder="Province">
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="postal-code">
                                    Postal Code
                                </label>
                                <input wire:model="postalCode" class="appearance-none block w-full bg-white-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="postal-code" type="text" placeholder="Postal Code">
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="phone-number">
                                    Phone Number
                                </label>
                                <input wire:model="phone" class="appearance-none block w-full bg-white-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-200" id="phone-number" type="text" placeholder=" Phone Number">
                            </div>
                        </div>

                        <div class="md:flex md:items-center mb-6">
                            <label class="md:w-3/3 block text-gray-500 font-bold">
                            <input class="mr-2 leading-tight" type="radio" value="1" wire:model="onlyShippingLabel" {{ $onlyShippingLabel == '1' ? 'checked' : '' }} >
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
                                                <input class="mr-2 leading-tight" name="paidCycle" type="radio" value="PAYPAL" wire:model="paymentMethod" {{ $paymentMethod == 'PAYPAL' ? 'checked' : '' }} >
                                                <span class="text-sm text-white radioImgBox">
                                                    <img src="{{asset('assets/images/paypal.png')}}" alt />
                                                </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="w-full md:w-1/3 px-3">
                                            <div class="md:flex md:items-center">
                                                <label class="block text-gray-500 font-bold radioWithImg">
                                                <input class="mr-2 leading-tight" name="paidCycle" type="radio" value="E-TRANSFER" wire:model="paymentMethod" {{ $paymentMethod == 'E-TRANSFER' ? 'checked' : '' }} >
                                                <span class="text-sm text-white radioImgBox">
                                                    <img src="{{asset('assets/images/interac.svg')}}" alt />
                                                </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="w-full md:w-1/3 px-3">
                                            <div class="md:flex md:items-center">
                                                <label class="block text-gray-500 font-bold radioWithImg">
                                                <input class="mr-2 leading-tight" name="paidCycle" type="radio" value="CHEQUE" wire:model="paymentMethod" {{ $paymentMethod == 'CHEQUE' ? 'checked' : '' }} >
                                                <span class="text-sm text-white">
                                                    Cheque
                                                </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <input wire:model="paymentEmail" class="appearance-none block w-full bg-white-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-200" id="payment-email" type="email" placeholder=" Payment Email*">
                            </div>
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
                <div class="w-5/12">

                    <div class="tabBody  p-6 relative col-span-9 bg-transparent bottomSidebar">
                        <div class="tabContent">

                            <div class="tabDescription flex">

                                <div class="tabRightBox border-l-0">
                                    <div class="price">
                                        <span class="currency">$</span>
                                        <span class="amount">10</span>
                                        <span class="decimalPoint">.00</span>
                                    </div>
                                    <div class="info">
                                        <a href="#." class="btnTheme">
                                            Enter a promo code*
                                        </a>
                                        <p>*We occasionally offer promo codes in our email blasts or <a href="#.">Facebook page</a></p>
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
