<?php

namespace App\Http\Livewire\Pages\Dashboard\SellOrders;

use App\Models\SellOrder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class ViewSellOrder extends Component
{
    use WithFileUploads;

    public $sell_order_id;
    // public $isNew;
    public $title;
    public $sellOrder;
    public $statuses;
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
    public $status;

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
                $this->status = $this->sellOrder->status;

                $this->title = "Sell Order";
                $this->sell_order_id = $sell_order_id;
                $this->statuses = $this->sellOrder->selfDropToLocation ? SellOrder::STATUSES_SELF_DROP : SellOrder::STATUSES_MAIL;

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

    public function save()
    {
        try {
            DB::beginTransaction();
            $rules = [
                'status'=> 'required',
            ];

            $this->validate($rules);
            $this->sellOrder->status = $this->status;
            $this->sellOrder->save();

            DB::commit();
            return redirect()->route('dashboard.sell-orders');

        }
        catch(\Illuminate\Validation\ValidationException $e){
            DB::rollBack();
            throw new \Illuminate\Validation\ValidationException($e);
        }
        catch (\Exception $e) {
            DB::rollBack();
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
            dd("Something Went Wrong", $e);
        }
    }

    public function render()
    {
        return view('livewire.pages.dashboard.sell-orders.view-sell-order');
    }
}
