<div>

    <x-slot name="header">
        <h1 class="font-semibold text-3xl text-gray-800 leading-tight adminHeading">
            {{ $title }}
        </h2>
    </x-slot>
    <x-slot name="headerBtn">
        <a  class="text-white font-bold py-2 px-4 rounded btnAdminTheme"  href="{{ route('dashboard.device-states.edit', 'new') }}">Add New State</a>
    </x-slot>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:pb-0">
        <div class="boxPanel py-6 px-6 bg-white rounded-lg mt-10">
        <table class="table-auto w-full">
            <th class="px-4 py-2 w-1/12 text-left">Condition</th>
            <th class="px-4 py-2 w-8/12 text-left">Features</th>
            <th class="px-4 py-2 text-right">Action</th>
            @foreach ($deviceStates as $deviceState)
            <tr>
                <td class="border px-4 py-2">{{ $deviceState->condition }} </td>
                <td class="border px-4 py-2">
                    <ul>
                        @foreach ($deviceState->features as $feature)
                            {{ $feature }}
                        @endforeach
                    </ul>
                </td>
                <td class="border px-4 py-2 text-right">
                    <a class="text-sm bg-white btnSmall hover:bg-white-700 text-black border border-gray-400 font-bold py-2 rounded"href="{{route('dashboard.device-states.edit', $deviceState->id)}}"> Edit </a>
                    <a class="text-sm bg-red-600 btnSmall hover:bg-red-700 text-white font-bold py-2 rounded" href="#." wire:click.prevent="delete({{$deviceState->id}})" > Delete </a>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $deviceStates->links() }}
        </div>
    </div>
</div>
