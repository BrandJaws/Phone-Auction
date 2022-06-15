<?php

namespace App\Http\Livewire\Pages\Dashboard\Devices\DeviceModels;

use App\Models\Device;
use App\Models\DeviceModel;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class DeviceModels extends Component
{
    use WithPagination;

    public $title = "Devices";
    public $device_id = null;

    public function mount($device_id)
    {
        try {
            $this->device_id = $device_id;
        } catch (\Exception $e) {
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
            dd("Something Went Wrong");
        }
    }

    public function delete($device_model_id)
    {
        try {

            // Fetch existing record against the device if any
            if ($device_model_id) {
                $deviceModel = DeviceModel::find($device_model_id);
                $path = str_replace('storage/', "", $deviceModel->image->imageUrl);
                Storage::disk('public')->delete($path);
                $deviceModel->image->delete();
                foreach ($deviceModel->quotes as $modelQuote) {
                    $modelQuote->delete();
                }
                $deviceModel->delete();
            }
            return redirect()->route('dashboard.devices.models', $this->device_id);
        } catch (\Exception $e) {
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
            dd("Something Went Wrong");
        }
    }

    public function render()
    {
        $device = Device::find($this->device_id);
        if (!$device) {
            abort(404);
        }
        $deviceModels = DeviceModel::where('device_id', $this->device_id)->orderBy('order', 'asc')->paginate(config('global.records_per_page'));
        return view('livewire.pages.dashboard.devices.device-models.device-models')->with([
            'device' => $device,
            'deviceModels' => $deviceModels
        ]);
    }
}
