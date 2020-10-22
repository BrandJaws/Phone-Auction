<?php

namespace App\Http\Livewire\Pages\Dashboard\SellOrders;

use App\Models\SellOrder;
use Livewire\Component;
use Livewire\WithFileUploads;

class ViewSellOrder extends Component
{
    use WithFileUploads;

    public $sell_order_id;
    // public $isNew;
    public $title;

    // Form fields for binding
    public $model_quote_id;
    public $name;
    public $email;
    public $address;
    public $city;
    public $province;
    public $postalCode;
    public $phone;
    public $onlyShippingLabel;
    public $paymentMethod;
    public $paymentEmail;

    public function mount($sell_order_id)
    {
        try {
            $this->title = "Sell Order";
            $this->device_id = null;
            if ($sell_order_id) {
                $sellOrder = SellOrder::find($sell_order_id);
                if (!$sellOrder) {
                    abort(404);
                }
                $this->model_quote_id = $sellOrder->model_quote_id;
                $this->name = $sellOrder->name;
                $this->email = $sellOrder->email;
                $this->address = $sellOrder->address;
                $this->city = $sellOrder->city;
                $this->province = $sellOrder->province;
                $this->postalCode = $sellOrder->postalCode;
                $this->phone = $sellOrder->phone;
                $this->onlyShippingLabel = $sellOrder->onlyShippingLabel;
                $this->paymentMethod = $sellOrder->paymentMethod;
                $this->paymentEmail = $sellOrder->paymentEmail;

                $this->title = "Sell Order";
                $this->sell_order_id = $sell_order_id;
            }
            $this->selectedOrderIndex = 0;
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
            $sellOrder = null;
            // Fetch existing record against the device if any
            if ($this->sell_order_id) {
                $sellOrder = SellOrder::find($this->sell_order_id);
                if (!$sellOrder) {
                    abort(404);
                }
            }

            $rules = [
                'model_quote_id' => 'exists:model_quotes,id',
                'name' => 'required|max:255',
                'email' => 'required|max:255',
                'address' => 'required|max:255',
                'city' => 'required|max:255',
                'province' => 'required|max:255',
                'postalCode' => 'required|max:255',
                'phone' => 'required|max:255',
                'onlyShippingLabel' => 'required|boolean',
                'paymentMethod' => 'required|max:255',
                'paymentEmail' => 'required|max:255',
            ];

            $this->validate($rules);

            // Create new instance if not found one
            if (!$sellOrder) {
                $sellOrder = new SellOrder();
            }

            $sellOrder->fill([
                "name" => $this->name,
                'email' => $this->email,
                'address' => $this->address,
                'city' => $this->city,
                'province' => $this->province,
                'postalCode' => $this->postalCode,
                'phone' => $this->phone,
                'onlyShippingLabel' => $this->onlyShippingLabel,
                'paymentMethod' => $this->paymentMethod,
                'paymentEmail' => $this->paymentEmail,
            ]);

            $sellOrder->save();
            return redirect()->route('dashboard.sell-orders');
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
        return view('livewire.pages.dashboard.sell-orders.view-sell-order');
    }
}
