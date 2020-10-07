<?php

namespace App\Http\Livewire\Pages\Dashboard\Devices;

use Livewire\Component;

class EditDevice extends Component
{
    public $title = "Edit Device";
    public function render()
    {
        return view('livewire.pages.dashboard.devices.edit-device');
    }
}
