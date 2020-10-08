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

    public function mount($device_id){
        $this->device_id = $device_id;
    }

    public function delete($device_model_id)
    {
        // Fetch existing record against the device if any
        if($device_model_id){
            $deviceModel = DeviceModel::find($device_model_id);
            $path = str_replace('storage/',"",$deviceModel->image->imageUrl);
            Storage::disk('public')->delete($path);
            $deviceModel->image->delete();
            $deviceModel->delete();

        }
        return redirect()->route('dashboard.devices.models', $this->device_id);
    }

    public function render()
    {
        $device = Device::find($this->device_id);
        if(!$device){
            abort(404);
        }
        $deviceModels = DeviceModel::where('device_id', $this->device_id)->paginate(2);
        return view('livewire.pages.dashboard.devices.device-models.device-models')->with([
                'device' => $device,
                'deviceModels' => $deviceModels
            ]);
    }
}
