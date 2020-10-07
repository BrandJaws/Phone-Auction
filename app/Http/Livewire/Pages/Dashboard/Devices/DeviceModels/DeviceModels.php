<?php

namespace App\Http\Livewire\Pages\Dashboard\Devices\DeviceModels;

use Livewire\Component;

class DeviceModels extends Component
{
    public $title = "Device Models";
    public function render()
    {
        return view('livewire.pages.dashboard.devices.device-models.device-models');
    }
}
