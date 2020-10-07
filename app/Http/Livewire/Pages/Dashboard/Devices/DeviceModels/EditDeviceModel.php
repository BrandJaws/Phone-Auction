<?php

namespace App\Http\Livewire\Pages\Dashboard\Devices\DeviceModels;

use Livewire\Component;

class EditDeviceModel extends Component
{
    public $title = "Edit Device Model";
    public function render()
    {
        return view('livewire.pages.dashboard.devices.device-models.edit-device-model');
    }
}
