<?php

namespace App\Http\Livewire\Pages\Dashboard\Devices;

use App\Models\Device;
use Livewire\Component;
use Livewire\WithPagination;

class Devices extends Component
{
    use WithPagination;

    public $title = "Devices";

    public function delete($device_id)
    {
        // Fetch existing record against the device if any
        if($device_id){
            $device = Device::find($device_id);
            $device->delete();
        }
        return redirect()->route('dashboard.devices');
    }

    public function render()
    {
        $devices = Device::paginate(2);
        return view('livewire.pages.dashboard.devices.devices')->with(['devices' => $devices]);
    }
}
