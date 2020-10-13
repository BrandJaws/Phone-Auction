<div>
    <x-slot name="header">
        <h1 class="font-semibold text-3xl text-gray-800 leading-tight">
            {{ $title }}
        </h1>
    </x-slot>
    <x-slot name="headerBtn">
        <a  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" 
            href="{{ route('dashboard.network-carriers.edit', 'new') }}">Add New Network Carriers</a>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:pb-0">
        <div class="boxPanel py-6 px-6 bg-white rounded-lg mt-10">
            <table class="table-auto w-7/12">
            <th class="px-4 py-2  w-7/12 text-left">Name</th>
            <th class="px-4 py-2 text-right">Action</th>
            @foreach ($networkCarriers as $networkCarrier)
            <tr>
                <td class="border px-4 py-2">{{ $networkCarrier->name }} </td>
                <td class="border px-4 py-2 text-right">
                    <a class="text-sm bg-white btnSmall hover:bg-white-700 text-black border border-gray-400 font-bold py-2 rounded"
                        href="{{route('dashboard.network-carriers.edit', $networkCarrier->id)}}"> Edit </a>
                    <a class="text-sm bg-red-600 btnSmall hover:bg-red-700 text-white font-bold py-2 rounded"
                        href="#." wire:click.prevent="delete({{$networkCarrier->id}})" > Delete </a>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $networkCarriers->links() }}
        </div>
    </div>
</div>
