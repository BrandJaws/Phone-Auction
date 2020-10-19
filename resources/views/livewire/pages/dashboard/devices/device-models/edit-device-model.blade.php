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
                    Model Info
                </h2>
            </div>
            <form method="POST"  class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" wire:submit.prevent="save" >
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                            {{ __('Name') }}
                        </label>

                        <input id="name" class="appearance-none block w-full bg-gray-200 text-gray-700 border-2 border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="text" required autofocus autocomplete="name" wire:model="name"/>
                        @error('name') <span class="error text-red-500 text-xs">{{ $message }}</span> @enderror

                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="image" >
                            {{ __('Image') }}
                        </label>
                        <input id="image" class="appearance-none block w-full bg-gray-200 text-gray-700 border-2 border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" type="file" wire:model="image"/>
                        <div wire:loading wire:target="image">Uploading...</div>
                        @error('image') <span class="error  text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
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
