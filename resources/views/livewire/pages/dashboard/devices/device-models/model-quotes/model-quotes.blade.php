<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>
    <h2>
        Quotes for {{ $deviceModel->name }}
    </h2>
    <div>
        <a href="{{ route('dashboard.devices.models.quotes.edit', ["device_id" => $device->id, "device_model_id" => $deviceModel->id, "model_quote_id" => "new"]) }}">Add</a>
    </div>
    <div class="container mx-auto">
        <table>
            <th>State</th>
            <th>Carrier</th>
            <th>Action</th>
            @foreach ($modelQuotes as $modelQuote)
            <tr>
                <td>{{ $modelQuote->device_state->condition }} </td>
                <td>{{ $modelQuote->network_carrier->name }} </td>
                <td>
                    <a href="{{route('dashboard.devices.models.quotes.edit', ["device_id" => $device->id, "device_model_id" => $modelQuote->id, "model_quote_id" => $modelQuote->id])}}"> Edit </a>
                    <a href="#." wire:click.prevent="delete({{$modelQuote->id}})" > Delete </a>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $modelQuotes->links() }}
    </div>
</div>
