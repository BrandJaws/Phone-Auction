<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>
    <div>
        <a href="{{ route('dashboard.device-states.edit', 'new') }}">Add</a>
    </div>
    <div class="container mx-auto">
        <table>
            <th>Condition</th>
            <th>Features</th>
            <th>Action</th>
            @foreach ($deviceStates as $deviceState)
            <tr>
                <td>{{ $deviceState->condition }} </td>
                <td>
                    <ul>
                        @foreach ($deviceState->features as $feature)
                            {{ $feature }}
                        @endforeach
                    </ul>
                </td>
                <td>
                    <a href="{{route('dashboard.device-states.edit', $deviceState->id)}}"> Edit </a>
                    <a href="#." wire:click.prevent="delete({{$deviceState->id}})" > Delete </a>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $deviceStates->links() }}
    </div>
</div>
