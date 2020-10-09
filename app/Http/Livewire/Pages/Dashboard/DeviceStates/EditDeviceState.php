<?php

namespace App\Http\Livewire\Pages\Dashboard\DeviceStates;

use App\Models\DeviceState;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditDeviceState extends Component
{
    use WithFileUploads;

    public $device_state_id;
    public $title;

    // Form fields for binding
    public $condition;
    public $features = ["","",""];

    public function mount($device_state_id){
        $this->title = "New Device State";
        $this->device_state_id = null;
        if($device_state_id !== 'new'){
            $deviceState = DeviceState::find($device_state_id);
            if(!$deviceState){
                abort(404);
            }
            $this->condition = $deviceState->condition;
            $this->features = $deviceState->features;
            $this->title = "Edit Device State";
            $this->device_state_id = $device_state_id;

        }
    }

    public function addFeature(){
        $this->features[] = "";
    }

    public function removeFeature($index){
        unset($this->features[$index]);
    }

    public function save()
    {
        $deviceState = null;
        // Fetch existing record against the device if any
        if($this->device_state_id){
            $deviceState = DeviceState::find($this->device_state_id);
            if(!$deviceState){
                abort(404);
            }
        }

        $rules = [
            'condition' => 'required|max:255',
            'features' => 'array',
        ];

        $this->validate($rules);

        // Create new instance if not found one
        if(!$deviceState){
            $deviceState = new DeviceState();
        }

        $deviceState->fill([
            "condition" => $this->condition,
            "features" => $this->features,
        ]);

        $deviceState->save();

        return redirect()->route('dashboard.device-states');
    }

    public function render()
    {
        return view('livewire.pages.dashboard.device-states.edit-device-state');
    }
}
