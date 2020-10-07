<?php

namespace App\Http\Livewire\Pages\Dashboard\DeviceStates;

use Livewire\Component;

class DeviceStates extends Component
{
    public $title = "Device States";
    public function render()
    {
        return view('livewire.pages.dashboard.device-states.device-states');
    }
}
