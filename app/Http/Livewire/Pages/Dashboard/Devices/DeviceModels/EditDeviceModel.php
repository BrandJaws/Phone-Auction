<?php

namespace App\Http\Livewire\Pages\Dashboard\Devices\DeviceModels;

use Livewire\Component;
use App\Models\Device;
use App\Models\DeviceModel;
use App\Models\Image;
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

    public function mount($device_id, $device_model_id){
        $this->title = "New Device Model";
        $this->device_id = null;
        $this->device_model_id = null;
        $device = Device::find($device_id);
        if(!$device){
            abort(404);
        }
        $this->device_id = $device_id;
        if($device_model_id !== 'new'){
            $deviceModel = DeviceModel::find($device_model_id);
            if(!$deviceModel){
                abort(404);
            }
            $this->name = $deviceModel->name;
            $this->title = "Edit Device Model";
            $this->device_model_id = $device_model_id;
        }
    }

    public function save()
    {
        $device = null;
        $deviceModel = null;
        // Fetch existing record against the device if any
        if($this->device_id){
            $device = Device::find($this->device_id);
            if(!$device){
                abort(404);
            }
        }
        // Fetch existing record against the device model if any
        if($this->device_model_id){
            $deviceModel = DeviceModel::find($this->device_model_id);
            if(!$deviceModel){
                abort(404);
            }
        }

        $rules = [
            'name' => 'required||max:255',
        ];
        // Add image validation only if new record
        if(!$this->device_model_id){
            $rules['image'] = 'image|max:1024';
        }
        $this->validate($rules);

        // Create new instance if not found one
        if(!$deviceModel){
            $deviceModel = new DeviceModel();
        }

        $deviceModel->fill([
            "device_id" => $device->id,
            "name"=>$this->name
        ]);

        $deviceModel->save();

        // Process image only if exists. It may not have been selected incase it was an edit of existing record
        if($this->image){
            $existingImages = Image::where("imageable_type", DeviceModel::class)
                                    ->where("imageable_id", $deviceModel->id)
                                    ->get();
            $imageName = Carbon::now()->toDateTimeString().'.'.$this->image->extension();
            $imageUrl = 'storage/uploads/device-models/'.$imageName;
            $this->image->storeAs('public/uploads/device-models/', $imageName);
            $image = new Image();
            $image->fill([
                "imageUrl" => $imageUrl,
                "imageable_type" => DeviceModel::class,
                "imageable_id" => $deviceModel->id,
            ])->save();
            foreach($existingImages as $image){
                $path = str_replace('storage/',"",$image->imageUrl);
                Storage::disk('public')->delete($path);
                $image->delete();
            }
        }

        return redirect()->route('dashboard.devices.models', $device->id);
    }
    public function render()
    {
        return view('livewire.pages.dashboard.devices.device-models.edit-device-model');
    }
}
