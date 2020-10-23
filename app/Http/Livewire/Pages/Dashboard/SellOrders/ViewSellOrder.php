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
    public $firstName;
    public $lastName;
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
                $this->firstName = $sellOrder->firstName;
                $this->lastName = $sellOrder->lastName;
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
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
            dd("Something Went Wrong");
        }
    }

    public function render()
    {
        return view('livewire.pages.dashboard.sell-orders.view-sell-order');
    }
}
