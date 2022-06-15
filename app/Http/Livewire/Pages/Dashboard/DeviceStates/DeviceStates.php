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

        try {
            // Fetch existing record against the device if any
            if ($device_state_id) {
                $deviceState = DeviceState::find($device_state_id);
                $deviceState->delete();
            }
            return redirect()->route('dashboard.device-states');
        } catch (\Exception $e) {
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
            dd("Something Went Wrong");
        }
    }

    public function render()
    {
        $deviceStates = DeviceState::paginate(config('global.records_per_page'));
        return view('livewire.pages.dashboard.device-states.device-states')->with(['deviceStates' => $deviceStates]);
    }
}
