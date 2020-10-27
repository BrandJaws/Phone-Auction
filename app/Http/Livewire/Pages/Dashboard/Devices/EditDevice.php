<?php

namespace App\Http\Livewire\Pages\Dashboard\Devices;

use App\Models\Device;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
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

    public function mount($device_id)
    {

        try {
            $this->title = "New Device";
            $this->device_id = null;
            if ($device_id !== 'new') {
                $device = Device::find($device_id);
                if (!$device) {
                    abort(404);
                }
                $this->name = $device->name;
                $this->title = "Edit Device";
                $this->device_id = $device_id;
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
            // Fetch existing record against the device if any
            if ($this->device_id) {
                $device = Device::find($this->device_id);
                if (!$device) {
                    abort(404);
                }
            }

            $rules = [
                'name' => 'required|max:255',
            ];
            // Add image validation only if new record
            if (!$this->device_id) {
                $rules['image'] = 'required|image|max:1024';
            } else if ($this->image) {
                $rules['image'] = 'image|max:1024';
            }
            $this->validate($rules);

            // Create new instance if not found one
            if (!$device) {
                $device = new Device();
            }

            $device->fill([
                "name" => $this->name
            ]);

            $device->save();

            // Process image only if exists. It may not have been selected incase it was an edit of existing record
            if ($this->image) {
                $existingImages = Image::where("imageable_type", Device::class)
                    ->where("imageable_id", $device->id)
                    ->get();
                $imageName = Carbon::now()->getTimestamp() . '.' . $this->image->extension();
                $imageUrl = 'storage/uploads/devices/' . $imageName;
                $this->image->storeAs('public/uploads/devices/', $imageName);

                $image = new Image();
                $image->fill([
                    "imageUrl" => $imageUrl,
                    "imageable_type" => Device::class,
                    "imageable_id" => $device->id,
                ])->save();
                foreach ($existingImages as $image) {
                    $path = str_replace('storage/', "", $image->imageUrl);
                    Storage::disk('public')->delete($path);
                    $image->delete();
                }
            }

            return redirect()->route('dashboard.devices');
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
        return view('livewire.pages.dashboard.devices.edit-device');
    }
}
