<?php

namespace App\Http\Livewire\Pages\Dashboard\Devices;

use Livewire\Component;

class Devices extends Component
{
    public $title = "Devices";
    public function render()
    {
        return view('livewire.pages.dashboard.devices.devices');
    }
}
