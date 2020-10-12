<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <table>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
            @foreach ($sellOrders as $sellOrder)
            <tr>
                <td>{{ $sellOrder->name }} </td>
                <td>{{ $sellOrder->email }} </td>
                <td>
                    <a href="{{route('dashboard.sell-orders.view', $sellOrder->id)}}"> View </a>
                    <a href="#." wire:click.prevent="delete({{$sellOrder->id}})" > Delete </a>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $sellOrders->links() }}
    </div>
</div>
