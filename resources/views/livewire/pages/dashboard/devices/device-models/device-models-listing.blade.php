<div>
    {{-- Be like water. --}}
    <x-slot name="header">
        <h1 class="font-semibold text-3xl text-gray-800 leading-tight adminHeading">
            {{ $title }}
        </h1>
    </x-slot>
    <x-slot name="headerBtn">
        <a class="text-white font-bold py-2 px-4 rounded btnAdminTheme"
           href="{{ route('dashboard.devices.models.edit', ["device_id" => $device->id, "device_model_id" => 'new']) }}">Add New Model</a>
    </x-slot>


    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:pb-0">
        <div class="boxPanel py-6 px-6 bg-white rounded-lg mt-10">
            <div class="panelHeading mb-5">
                <h2 class="font-semibold text-xl text-black leading-tight">
                    Models for {{ $device->name }}
                </h2>
            </div>
            <table class="table-auto w-7/12">
                <thead>
                    <th class="px-4 py-2  w-7/12 text-left">Device Name</th>
                    <th class="px-4 py-2 text-right">Action</th>
                </thead>
                <tbody wire:sortable="reOrderModels">
                    @foreach ($deviceModels as $deviceModel)
                    <tr wire:sortable.item="{{ $deviceModel->id }}" draggable="true">
                        <td class="border px-4 py-2">{{ $deviceModel->name }} </td>
                        <td class="border px-4 py-2 text-right">
                            <a class="text-sm bg-white btnSmall hover:bg-white-700 text-black border border-gray-400 font-bold py-2 rounded" href="{{route('dashboard.devices.models.edit', ["device_id" => $device->id, "device_model_id" => $deviceModel->id])}}"> Edit </a>
                            <a class="text-sm bg-red-600 btnSmall hover:bg-red-700 text-white font-bold py-2 rounded" href="#." wire:click.prevent="delete({{$deviceModel->id}})" > Delete </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
