<?php

namespace App\Http\Livewire\Pages\Dashboard\NetworkCarriers;

use App\Models\NetworkCarrier;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class NetworkCarriers extends Component
{
    use WithPagination;

    public $title = "Network Carriers";

    public function delete($network_carrier_id)
    {

        try {
            // Fetch existing record against the device if any
            if ($network_carrier_id) {
                $networkCarrier = NetworkCarrier::find($network_carrier_id);
                $path = str_replace('storage/', "", $networkCarrier->image->imageUrl);
                Storage::disk('public')->delete($path);
                $networkCarrier->image->delete();
                $networkCarrier->delete();
            }
            return redirect()->route('dashboard.network-carriers');
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
        $networkCarriers = NetworkCarrier::paginate(config('global.records_per_page'));
        return view('livewire.pages.dashboard.network-carriers.network-carriers')->with(['networkCarriers' => $networkCarriers]);
    }
}
