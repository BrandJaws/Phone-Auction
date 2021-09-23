<?php

namespace App\Http\Livewire\Pages\Dashboard\Devices\DeviceModels;

use App\Models\Device;
use App\Models\DeviceModel;
use Livewire\Component;

class DeviceModelsListing extends Component
{
    public $title = "Device Models";
    public $device_id;
    public $device_model_detail;
    public $deviceModels;

    public function mount($device_id, $device_model_detail)
    {
        try {
            if ($device_model_detail === 'listing') {
                $this->device_id = $device_id;
                $this->device_model_detail = $device_model_detail;
                $device = Device::find($device_id);
                if (!$device) {
                    abort(404);
                }
                $this->deviceModels = DeviceModel::where('device_id', $this->device_id)->orderBy('order', 'asc')->get();
            }
        } catch (\Exception $e) {
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
            dd("Something Went Wrong");
        }
    }

    public function reOrderModels($orderedIds)
    {
        $device = Device::where('id', $this->device_id)->with('models.image')->first();
        foreach ($device->models as $index => $model) {
            $selectedDeviceModel = $device->models->where('id', $orderedIds[$index]["value"])->first();
            $selectedDeviceModel->order = $orderedIds[$index]["order"];
            $selectedDeviceModel->save();
        }
        $device->models = $device->models->sortBy('order');
        $this->deviceModels = $device->models;
    }

    public function render()
    {
        $device = Device::find($this->device_id);
        if (!$device) {
            abort(404);
        }
        $this->deviceModels = DeviceModel::where('device_id', $this->device_id)->orderBy('order', 'asc')->get();
        return view('livewire.pages.dashboard.devices.device-models.device-models-listing')->with([
            'device' => $device,
            'deviceModels' => $this->deviceModels
        ]);
    }
}
