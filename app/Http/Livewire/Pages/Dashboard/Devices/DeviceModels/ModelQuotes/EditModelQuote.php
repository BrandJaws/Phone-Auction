<?php

namespace App\Http\Livewire\Pages\Dashboard\Devices\DeviceModels\ModelQuotes;

use Livewire\Component;
use App\Models\Device;
use App\Models\DeviceModel;
use App\Models\DeviceState;
use App\Models\Image;
use App\Models\ModelQuote;
use App\Models\NetworkCarrier;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class EditModelQuote extends Component
{
    use WithFileUploads;

    public $device_id;
    public $device_model_id;
    public $model_quote_id;
    public $title;
    public $deviceStates;
    public $networkCarriers;

    // Form fields for binding
    public $device_state_id;
    public $network_carrier_id;
    public $quote_price;

    public function mount($device_id, $device_model_id, $model_quote_id)
    {
        try {
            $this->title = "New  Model Quote";
            $this->device_id = null;
            $this->device_model_id = null;
            $this->model_quote_id = null;
            $device = Device::find($device_id);
            if (!$device) {
                abort(404);
            }
            $deviceModel = DeviceModel::find($device_model_id);
            if (!$deviceModel) {
                abort(404);
            }

            $this->device_id = $device_id;
            $this->device_model_id = $device_model_id;
            $this->deviceStates = DeviceState::all();
            $this->networkCarriers = NetworkCarrier::all();

            if ($model_quote_id !== 'new') {
                $modelQuote = ModelQuote::find($model_quote_id);
                if (!$modelQuote) {
                    abort(404);
                }
                $this->title = "Edit Model Quote";
                $this->model_quote_id = $model_quote_id;
                $this->device_state_id = $modelQuote->device_state_id;
                $this->network_carrier_id = $modelQuote->network_carrier_id;
                $this->quote_price = $modelQuote->quote_price;
            }
        } catch (\Exception $e) {
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
            dd("Something Went Wrong");
        }
    }

    public function save()
    {
        try {
            $device = null;
            $deviceModel = null;
            $modelQuote = null;
            // Fetch existing record against the device if any
            if ($this->device_id) {
                $device = Device::find($this->device_id);
                if (!$device) {
                    abort(404);
                }
            }
            // Fetch existing record against the device model if any
            if ($this->device_model_id) {
                $deviceModel = DeviceModel::find($this->device_model_id);
                if (!$deviceModel) {
                    abort(404);
                }
            }

            // Fetch existing record against the model quote if any
            if ($this->model_quote_id) {
                $modelQuote = ModelQuote::find($this->model_quote_id);
                if (!$modelQuote) {
                    abort(404);
                }
            }



            $rules = [
                'device_state_id' => 'required|integer',
                'network_carrier_id' => 'required|integer',
                'quote_price' => 'required|numeric',
            ];

            $this->validate($rules);
            // Create new instance if not found one
            if (!$modelQuote) {
                $modelQuote = new ModelQuote();
            }

            $modelQuote->fill([
                "device_model_id" => $deviceModel->id,
                'device_state_id' => $this->device_state_id,
                'network_carrier_id' => $this->network_carrier_id,
                'quote_price' => $this->quote_price,
            ]);

            $modelQuote->save();

            return redirect()->route('dashboard.devices.models.quotes', ["device_id" => $device->id, "device_model_id" => $deviceModel->id]);
        } catch(\Illuminate\Validation\ValidationException $e){
            throw new \Illuminate\Validation\ValidationException($e);
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
        return view('livewire.pages.dashboard.devices.device-models.model-quotes.edit-model-quote');
    }
}
