<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>
    <div>
        <a href="{{ route('dashboard.network-carriers.edit', 'new') }}">Add</a>
    </div>
    <div class="container mx-auto">
        <table>
            <th>Name</th>
            <th>Action</th>
            @foreach ($networkCarriers as $networkCarrier)
            <tr>
                <td>{{ $networkCarrier->name }} </td>
                <td>
                    <a href="{{route('dashboard.network-carriers.edit', $networkCarrier->id)}}"> Edit </a>
                    <a href="#." wire:click.prevent="delete({{$networkCarrier->id}})" > Delete </a>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $networkCarriers->links() }}
    </div>
</div>
