<?php

namespace App\Http\Livewire\Pages\Dashboard\NetworkCarriers;

use App\Models\NetworkCarrier;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditNetworkCarrier extends Component
{
    use WithFileUploads;

    public $network_carrier_id;
    // public $isNew;
    public $title;

    // Form fields for binding
    public $name;
    public $image;

    public function mount($network_carrier_id)
    {

        try {
            $this->title = "New Network Carrier";
            $this->network_carrier_id = 'new';
            if ($network_carrier_id !== 'new') {
                $networkCarrier = NetworkCarrier::find($network_carrier_id);
                if (!$networkCarrier) {
                    abort(404);
                }
                $this->name = $networkCarrier->name;
                $this->title = "Edit Network Carrier";
                $this->network_carrier_id = $network_carrier_id;
            }
        } catch (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e){
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException($e);
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
            $networkCarrier = null;
            // Fetch existing record against the network carrier if any
            if ($this->network_carrier_id !== 'new') {
                $networkCarrier = NetworkCarrier::find($this->network_carrier_id);
                if (!$networkCarrier) {
                    abort(404);
                }
            }

            $rules = [
                'name' => 'required|max:255',
            ];
            // Add image validation only if new record
            // Add image validation only if new record
            if ($this->network_carrier_id === 'new') {
                $rules['image'] = 'required|image|max:1024';
            } else if ($this->image) {
                $rules['image'] = 'image|max:1024';
            }

            $this->validate($rules);

            // Create new instance if not found one
            if (!$networkCarrier) {
                $networkCarrier = new NetworkCarrier();
            }

            $networkCarrier->fill([
                "name" => $this->name
            ]);

            $networkCarrier->save();

            // Process image only if exists. It may not have been selected incase it was an edit of existing record
            if ($this->image) {
                $existingImages = Image::where("imageable_type", NetworkCarrier::class)
                    ->where("imageable_id", $networkCarrier->id)
                    ->get();
                $imageName = Carbon::now()->getTimestamp() . '.' . $this->image->extension();
                $imageUrl = 'storage/uploads/network-carriers/' . $imageName;
                $this->image->storeAs('public/uploads/network-carriers/', $imageName);
                $image = new Image();
                $image->fill([
                    "imageUrl" => $imageUrl,
                    "imageable_type" => NetworkCarrier::class,
                    "imageable_id" => $networkCarrier->id,
                ])->save();
                foreach ($existingImages as $image) {
                    $path = str_replace('storage/', "", $image->imageUrl);
                    Storage::disk('public')->delete($path);
                    $image->delete();
                }
            }

            return redirect()->route('dashboard.network-carriers');
        } catch(\Illuminate\Validation\ValidationException $e){
            throw new \Illuminate\Validation\ValidationException($e);
        } catch (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e){
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException($e);
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
        return view('livewire.pages.dashboard.network-carriers.edit-network-carrier');
    }
}
