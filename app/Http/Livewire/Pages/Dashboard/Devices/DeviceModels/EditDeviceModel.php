<?php

namespace App\Http\Livewire\Pages\Dashboard\Devices\DeviceModels;

use Livewire\Component;

class EditDeviceModel extends Component
{
    public $device_model_id;
    public $title;

    public function mount($device_model_id){
        if($device_model_id === 'new'){
            $this->title = "New Device Model";
        }else{
            $this->title = "Edit Device Model";
        }
        $this->device_model_id = $device_model_id;
    }

    public function render()
    {
        return view('livewire.pages.dashboard.devices.device-models.edit-device-model');
    }
}
