<?php

namespace App\Http\Livewire\Pages\Dashboard\Devices;

use App\Models\Device;
use App\Models\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditDevice extends Component
{
    use WithFileUploads;

    public $device_id;
    // public $isNew;
    public $title;

    // Form fields for binding
    public $name;
    public $image;

    public function mount($device_id){
        $this->title = "New Device";
        $this->device_id = null;
        if($device_id !== 'new'){
            $device = Device::find($device_id);
            if($device){
                $this->name = $device->name;
                $this->title = "Edit Device";
                $this->device_id = $device_id;
            }
        }
    }

    public function save()
    {
        $device = null;
        // Fetch existing record against the device if any
        if($this->device_id){
            $device = Device::find($this->device_id);
            if(!$device){
                $this->device_id = null;
            }
        }

        $rules = [
            'name' => 'required||max:255',
        ];
        // Add image validation only if new record
        if(!$this->device_id){
            $rules['image'] = 'image|max:1024';
        }
        $this->validate($rules);

        // Create new instance if not found one
        if(!$device){
            $device = new Device();
        }

        $device->fill([
            "name"=>$this->name
        ]);

        $device->save();

        // Process image only if exists. It may not have been selected incase it was an edit of existing record
        if($this->image){
            $imageName = strval($device->id).'.'.$this->image->extension();
            $imageUrl = 'uploads/devices/'.$imageName;
            $this->image->storeAs('uploads/devices/', $imageName);
            $image = new Image();
            $image->fill([
                "imageUrl" => $imageUrl,
                "imageable_type" => Device::class,
                "imageable_id" => $device->id,
            ])->save();
        }

        return redirect()->route('dashboard.devices');
    }

    public function render()
    {
        return view('livewire.pages.dashboard.devices.edit-device');
    }
}
