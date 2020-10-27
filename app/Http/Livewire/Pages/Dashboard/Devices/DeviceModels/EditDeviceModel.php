<?php

namespace App\Http\Livewire\Pages\Dashboard\Devices\DeviceModels;

use Livewire\Component;
use App\Models\Device;
use App\Models\DeviceModel;
use App\Models\DeviceState;
use App\Models\Image;
use App\Models\ModelQuote;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class EditDeviceModel extends Component
{
    use WithFileUploads;

    public $device_id;
    public $device_model_id;
    // public $isNew;
    public $title;

    // Form fields for binding
    public $name;
    public $image;

    public $deviceStates;
    public $quotes = [];
    public $quotesErrors = [];

    public function mount($device_id, $device_model_id)
    {
        try {
            $this->title = "New Device Model";
            $this->device_id = null;
            $this->device_model_id = null;
            $device = Device::find($device_id);
            if (!$device) {
                abort(404);
            }
            $this->device_id = $device_id;

            // Get device states
            $this->deviceStates = DeviceState::all();
            // Create a dummy quote for each state
            foreach ($this->deviceStates as $deviceState) {
                $this->quotes[] = [
                    "id" => null,
                    "condition" => $deviceState->condition,
                    "device_model_id" => null,
                    "device_state_id" => $deviceState->id,
                    "network_carrier_id" => null,
                    "quote_price" => 0,
                ];
            }

            if ($device_model_id !== 'new') {
                $deviceModel = DeviceModel::where('id', $device_model_id)->with('quotes')->first();
                if (!$deviceModel) {
                    abort(404);
                }
                $this->name = $deviceModel->name;
                $this->title = "Edit Device Model";
                $this->device_model_id = $device_model_id;

                // Populate Quotes for an existing model

                foreach ($this->quotes as $index => $editableQuote) {
                    $this->quotes[$index]["device_model_id"] = $device_model_id;
                    foreach ($deviceModel->quotes as $quote) {
                        if ($quote->device_state_id === $editableQuote["device_state_id"]) {
                            $this->quotes[$index]["id"] = $quote->id;
                            $this->quotes[$index]["quote_price"] = $quote->quote_price;
                            break;
                        }
                    }
                }
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

            $rules = [
                'name' => 'required|max:255',
                'quotes.*.device_state_id' => 'required',
                'quotes.*.quote_price' => 'required|numeric',
            ];

            // Add image validation only if new record
            if (!$this->device_model_id) {
                $rules['image'] = 'required|image|max:1024';
            } else if ($this->image) {
                $rules['image'] = 'image|max:1024';
            }

            $this->validate($rules);

            // Create new instance if not found one
            if (!$deviceModel) {
                $deviceModel = new DeviceModel();
            }

            $deviceModel->fill([
                "device_id" => $device->id,
                "name" => $this->name
            ]);

            $deviceModel->save();

            // Process image only if exists. It may not have been selected incase it was an edit of existing record
            if ($this->image) {
                $existingImages = Image::where("imageable_type", DeviceModel::class)
                    ->where("imageable_id", $deviceModel->id)
                    ->get();
                $imageName = Carbon::now()->getTimestamp() . '.' . $this->image->extension();
                $imageUrl = 'storage/uploads/device-models/' . $imageName;
                $this->image->storeAs('public/uploads/device-models/', $imageName);
                $image = new Image();
                $image->fill([
                    "imageUrl" => $imageUrl,
                    "imageable_type" => DeviceModel::class,
                    "imageable_id" => $deviceModel->id,
                ])->save();
                foreach ($existingImages as $image) {
                    $path = str_replace('storage/', "", $image->imageUrl);
                    Storage::disk('public')->delete($path);
                    $image->delete();
                }
            }

            // Process Model Quotes

            foreach ($this->quotes as $index => $quote) {
                $record = null;
                $quote["device_model_id"] = $deviceModel->id;
                if ($quote["id"]) {
                    $record = ModelQuote::find($quote["id"]);
                }
                if (!$record) {
                    $record = new ModelQuote();
                }
                $record->fill($quote)->save();
            }

            return redirect()->route('dashboard.devices.models', $device->id);

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
        return view('livewire.pages.dashboard.devices.device-models.edit-device-model');
    }
}
