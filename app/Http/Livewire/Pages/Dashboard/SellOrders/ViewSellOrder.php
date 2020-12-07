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
    public $sellOrder;
    // Form fields for binding
    public $selfDropLocationName = "";
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
                $this->sellOrder = SellOrder::where('id', $sell_order_id)
                                            ->with('drop_location', 'items.selectedDeviceModel', 'items.selectedNetworkCarrier', 'items.selectedQuote')
                                            ->first();
                if (!$this->sellOrder) {
                    abort(404);
                }
                $this->selfDropLocationName = $this->sellOrder->drop_location ? $this->sellOrder->drop_location->name : "";
                $this->model_quote_id = $this->sellOrder->model_quote_id;
                $this->firstName = $this->sellOrder->firstName;
                $this->lastName = $this->sellOrder->lastName;
                $this->email = $this->sellOrder->email;
                $this->address = $this->sellOrder->address;
                $this->city = $this->sellOrder->city;
                $this->province = $this->sellOrder->province;
                $this->postalCode = $this->sellOrder->postalCode;
                $this->phone = $this->sellOrder->phone;
                $this->onlyShippingLabel = $this->sellOrder->onlyShippingLabel;
                $this->paymentMethod = $this->sellOrder->paymentMethod;
                $this->paymentEmail = $this->sellOrder->paymentEmail;

                $this->title = "Sell Order";
                $this->sell_order_id = $sell_order_id;
            }
            $this->selectedOrderIndex = 0;
        } catch(\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e){
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException($e);
        }
        catch (\Exception $e) {
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
