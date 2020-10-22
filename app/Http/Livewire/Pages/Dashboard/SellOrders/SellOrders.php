<?php

namespace App\Http\Livewire\Pages\Dashboard\SellOrders;

use App\Models\SellOrder;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class SellOrders extends Component
{
    use WithPagination;

    public $title = "Sell Orders";

    public function delete($sell_order_id)
    {

        try {
            // Fetch existing record against the device if any
            if ($sell_order_id) {
                $sellOrder = SellOrder::find($sell_order_id);
                $sellOrder->delete();
            }
            return redirect()->route('dashboard.sell-orders');
        } catch (\Exception $e) {
            dd("Something Went Wrong");
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
        }
    }

    public function render()
    {
        $sellOrders = SellOrder::paginate(config('global.records_per_page'));
        return view('livewire.pages.dashboard.sell-orders.sell-orders')->with(['sellOrders' => $sellOrders]);
    }
}
