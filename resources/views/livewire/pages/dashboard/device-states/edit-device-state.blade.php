<div>
    <x-slot name="header">
        <h1 class="font-semibold text-3xl text-gray-800 leading-tight">
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
                Device State Info
                </h2>
            </div>
            <form method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" wire:submit.prevent="save" >
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div  class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="condition" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >{{ __('Condition') }}</label>
                        <input id="condition" class="appearance-none block w-full bg-gray-200 text-gray-700 border-2 border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" required autofocus autocomplete="condition" wire:model="condition"/>
                        @error('condition') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div  class="w-full md:w-1/2 pl-0 px-3 mb-6 md:mb-0">
                    <label for="features" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >{{ __('Features') }}</label>
                    
                    @foreach ($features as $featureIndex => $feature)
                        <div class="mt-2 inline-block w-full">
                            <input id="features.{{$featureIndex}}" class="float-left withBtn appearance-none block w-full bg-gray-200 text-gray-700 border-2 border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" wire:model="features.{{$featureIndex}}"/>
                            <button
                            class="float-right bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                            wire:click.prevent="removeFeature({{$featureIndex}})">-</button>
                        </div>
                    @endforeach
                    <div class="text-right mt-2">
                    <button wire:click.prevent="addFeature" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add New Feature</button>
                    </div>
                    @error('features') <span class="error">{{ $message }}</span> @enderror
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
