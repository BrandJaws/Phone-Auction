<?php

namespace App\Http\Livewire\Pages\Dashboard\DeviceStates;

use App\Models\DeviceState;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class DeviceStates extends Component
{
    use WithPagination;

    public $title = "DeviceStates";

    public function delete($device_state_id)
    {
        // Fetch existing record against the device if any
        if($device_state_id){
            $deviceState = DeviceState::find($device_state_id);
            $deviceState->delete();
        }
        return redirect()->route('dashboard.device-states');
    }

    public function render()
    {
        $deviceStates = DeviceState::paginate(2);
        return view('livewire.pages.dashboard.device-states.device-states')->with(['deviceStates' => $deviceStates]);
    }
}
