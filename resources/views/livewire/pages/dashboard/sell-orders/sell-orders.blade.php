<div>
    <x-slot name="header">
    <h1 class="font-semibold text-3xl text-gray-800 leading-tight adminHeading">
            {{ $title }}
        </h1>
    </x-slot>
    <x-slot name="headerBtn">
        &nbsp;
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:pb-0">
        <div class="boxPanel py-6 px-6 bg-white rounded-lg mt-10">
            <table class="table-auto w-12/12">
                <th class="px-4 py-2  w-3/12 text-left">Name</th>
                <th class="px-4 py-2  w-3/12 text-left">Email</th>
                <th class="px-4 py-2  w-2/12 text-left">Order Type</th>
                <th class="px-4 py-2  w-2/12 text-left">Status</th>
                <th class="px-4 py-2 w-2/12 text-right">Action</th>
                @foreach ($sellOrders as $sellOrder)
                <tr>
                    <td class="border px-4 py-2">{{ !$sellOrder->selfDropToLocation ? $sellOrder->firstName.' '.$sellOrder->lastName : '-' }} </td>
                    <td class="border px-4 py-2">{{ $sellOrder->paymentEmail }} </td>
                    <td class="border px-4 py-2">{{ $sellOrder->selfDropToLocation ? 'Drop At Store ('.$sellOrder->drop_location->name.')' : 'Mail' }} </td>
                    <td class="border px-4 py-2">{{ $sellOrder->status }} </td>
                    <td class="border px-4 py-2 text-right">
                        <a class="text-sm bg-white btnSmall hover:bg-white-700 text-black border border-gray-400 font-bold py-2 rounded" href="{{route('dashboard.sell-orders.view', $sellOrder->id)}}"> View </a>
                        <a class="text-sm bg-red-600 btnSmall hover:bg-red-700 text-white font-bold py-2 rounded" href="#." wire:click.prevent="delete({{$sellOrder->id}})" > Delete </a>
                    </td>
                </tr>
                @endforeach
            </table>
            {{ $sellOrders->links() }}
        </div>
    </div>
</div>
