<?php

namespace App\Http\Livewire\Pages\Dashboard\Devices;

use App\Models\Device;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Devices extends Component
{
    use WithPagination;

    public $title = "Devices";

    public function delete($device_id)
    {
        try {

            // Fetch existing record against the device if any
            if ($device_id) {
                $device = Device::find($device_id);
                $path = str_replace('storage/', "", $device->image->imageUrl);
                Storage::disk('public')->delete($path);
                $device->image->delete();
                foreach ($device->models as $deviceModel) {
                    $path = str_replace('storage/', "", $deviceModel->image->imageUrl);
                    Storage::disk('public')->delete($path);
                    $deviceModel->image->delete();
                    foreach ($deviceModel->quotes as $modelQuote) {
                        $modelQuote->delete();
                    }
                    $deviceModel->delete();
                }
                $device->delete();
            }
            return redirect()->route('dashboard.devices');
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
        $devices = Device::paginate(config('global.records_per_page'));
        return view('livewire.pages.dashboard.devices.devices')->with(['devices' => $devices]);
    }
}
