<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>
    <div>
        <a href="{{ route('dashboard.devices.edit', 'new') }}">Add</a>
    </div>
    <div class="container mx-auto">
        <table>
            <th>Device Name</th>
            <th>Action</th>
            @foreach ($devices as $device)
            <tr>
                <td>{{ $device->name }} </td>
                <td>
                    <a href="{{route('dashboard.devices.edit', $device->id)}}"> Edit </a>
                    <a href="#." wire:click.prevent="delete({{$device->id}})" > Delete </a>
                    <a href="{{route('dashboard.devices.models', $device->id)}}" > Models </a>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $devices->links() }}
    </div>
</div>
