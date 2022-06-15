<?php

namespace App\Http\Livewire\Pages\Dashboard\Devices\DeviceModels\ModelQuotes;

use App\Models\Device;
use App\Models\DeviceModel;
use App\Models\ModelQuote;
use Livewire\Component;
use Livewire\WithPagination;

class ModelQuotes extends Component
{
    use WithPagination;

    public $title = "Model Quotes";
    public $device_id = null;
    public $device_model_id = null;

    public function mount($device_id, $device_model_id)
    {
        try {
            $this->device_id = $device_id;
            $this->device_model_id = $device_id;
        } catch (\Exception $e) {
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
            dd("Something Went Wrong");
        }
    }

    public function delete($model_quote_id)
    {
        try {
            // Fetch existing record against the device if any
            if ($model_quote_id) {
                $modelQuote = ModelQuote::find($model_quote_id);
                $modelQuote->delete();
            }
            return redirect()->route('dashboard.devices.models', $this->device_id);
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
        $device = Device::find($this->device_id);
        if (!$device) {
            abort(404);
        }
        $deviceModel = DeviceModel::find($this->device_model_id);
        if (!$deviceModel) {
            abort(404);
        }

        $modelQuotes = ModelQuote::where('device_model_id', $this->device_model_id)
            ->with('device_state', 'network_carrier')
            ->paginate(config('global.records_per_page'));
        return view('livewire.pages.dashboard.devices.device-models.model-quotes.model-quotes')->with([
            'device' => $device,
            'deviceModel' => $deviceModel,
            'modelQuotes' => $modelQuotes
        ]);
    }
}
