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
    public $features = ["", "", ""];

    public function mount($device_state_id)
    {

        try {

            $this->title = "New Device State";
            $this->device_state_id = null;
            if ($device_state_id !== 'new') {
                $deviceState = DeviceState::find($device_state_id);
                if (!$deviceState) {
                    abort(404);
                }
                $this->condition = $deviceState->condition;
                $this->features = $deviceState->features;
                $this->title = "Edit Device State";
                $this->device_state_id = $device_state_id;
            }
        } catch (\Exception $e) {
            dd("Something Went Wrong");
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
        }
    }

    public function addFeature()
    {

        try {
            $this->features[] = "";
        } catch (\Exception $e) {
            dd("Something Went Wrong");
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
        }
    }

    public function removeFeature($index)
    {

        try {
            unset($this->features[$index]);
        } catch (\Exception $e) {
            dd("Something Went Wrong");
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
        }
    }

    public function save()
    {

        try {
            $deviceState = null;
            // Fetch existing record against the device if any
            if ($this->device_state_id) {
                $deviceState = DeviceState::find($this->device_state_id);
                if (!$deviceState) {
                    abort(404);
                }
            }

            $rules = [
                'condition' => 'required|max:255',
                'features' => 'array',
            ];

            $this->validate($rules);

            // Create new instance if not found one
            if (!$deviceState) {
                $deviceState = new DeviceState();
            }

            $deviceState->fill([
                "condition" => $this->condition,
                "features" => $this->features,
            ]);

            $deviceState->save();

            return redirect()->route('dashboard.device-states');
        } catch (\Exception $e) {
            dd("Something Went Wrong");
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.pages.dashboard.device-states.edit-device-state');
    }
}
