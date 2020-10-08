<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>
    <h2>
        Models for {{ $device->name }}
    </h2>
    <div>
        <a href="{{ route('dashboard.devices.models.edit', ["device_id" => $device->id, "device_model_id" => 'new']) }}">Add</a>
    </div>
    <div class="container mx-auto">
        <table>
            <th>Device Name</th>
            <th>Action</th>
            @foreach ($deviceModels as $deviceModel)
            <tr>
                <td>{{ $deviceModel->name }} </td>
                <td>
                    <a href="{{route('dashboard.devices.models.edit', ["device_id" => $device->id, "device_model_id" => $deviceModel->id])}}"> Edit </a>
                    <a href="#." wire:click.prevent="delete({{$deviceModel->id}})" > Delete </a>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $deviceModels->links() }}
    </div>
</div>
