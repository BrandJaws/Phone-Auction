<?php

namespace App\Http\Livewire\Pages;

use App\Models\Device;
use App\Models\DeviceModel;
use App\Models\NetworkCarrier;
use App\Models\SellOrder;
use App\Models\SellOrderItem;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Home extends Component
{
    public $sellOrderItems = [];
    public $completedSellOrderItems = [];
    public $selectedOrderIndex;

    public $devices;
    public $networkCarriers;
    public $formVisible = false;
    public $netTotal = 0;
    public $netTotalWhole = 0;
    public $netTotalDecimal = 0;

    // Form binding fields
    public $model_quote_id = "";
    public $firstName = "";
    public $lastName = "";
    public $email = "";
    public $address = "";
    public $city = "";
    public $province = "";
    public $postalCode = "";
    public $phone = "";
    public $onlyShippingLabel = "1";
    public $paymentMethod = "PAYPAL";
    public $paymentEmail = "";
    public $promoCode = "";

    protected $listeners = ['refreshComponent' => '$refresh'];

    private function getBlankSellOrderItem()
    {
        return [
            "selectedDevice" => null,
            "selectedDeviceModel" => null,
            "selectedNetworkCarrier" => null,
            "selectedQuote" => null,
            "completed" => false,
            "promoCode" => null
        ];
    }


    public function mount()
    {

        try {
            $this->devices = Device::with('image')->get();
            $this->networkCarriers = NetworkCarrier::with('image')->get();
            $this->sellOrderItems[] = $this->getBlankSellOrderItem();
            $this->selectedOrderIndex = 0;
        } catch (\Exception $e) {
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
            dd("Something Went Wrong");
        }
    }

    public function selectDevice($deviceId)
    {
        try {
            $this->formVisible = false;
            $this->sellOrderItems[$this->selectedOrderIndex]["selectedDeviceModel"] = null;
            $this->sellOrderItems[$this->selectedOrderIndex]["selectedNetworkCarrier"] = null;
            $this->sellOrderItems[$this->selectedOrderIndex]["selectedQuote"] = null;
            $this->setCurrentSellOrderItemAsComplete(false);

            $this->sellOrderItems[$this->selectedOrderIndex]["selectedDevice"] = Device::where('id', $deviceId)
                ->with('models.image')
                ->first()->toArray();
            $this->emit('scrollToSection', 'modelSelectionSection');
        } catch (\Exception $e) {
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
            dd("Something Went Wrong");
        }
    }

    public function selectDeviceModel($deviceModelId)
    {

        try {
            $this->formVisible = false;
            $this->sellOrderItems[$this->selectedOrderIndex]["selectedNetworkCarrier"] = null;
            $this->sellOrderItems[$this->selectedOrderIndex]["selectedQuote"] = null;
            $this->setCurrentSellOrderItemAsComplete(false);

            $deviceModel = DeviceModel::where('id', $deviceModelId)
                ->with('quotes.device_state')
                ->first();
            foreach ($deviceModel->quotes as $quote) {
                $quotePriceComponents = explode(".", $quote->quote_price);
                $quote->quote_price_whole = $quotePriceComponents[0];
                $quote->quote_price_decimal = $quotePriceComponents[1];
            }
            $this->sellOrderItems[$this->selectedOrderIndex]["selectedDeviceModel"] = $deviceModel->toArray();
            if (count($this->sellOrderItems[$this->selectedOrderIndex]["selectedDeviceModel"]["quotes"]) > 0) {
                $this->sellOrderItems[$this->selectedOrderIndex]["selectedQuote"] = $this->sellOrderItems[$this->selectedOrderIndex]["selectedDeviceModel"]["quotes"][0];
            }
            $this->emit('scrollToSection', 'networkSelectionSection');
        } catch (\Exception $e) {
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
            dd("Something Went Wrong");
        }
    }

    public function selectNetworkCarrier($networkCarrierId)
    {

        try {
            $this->sellOrderItems[$this->selectedOrderIndex]["selectedNetworkCarrier"] = $this->networkCarriers->where('id', $networkCarrierId)->first();
            $this->emit('scrollToSection', 'quoteSelectionSection');
        } catch (\Exception $e) {
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
            dd("Something Went Wrong");
        }
    }

    public function selectQuote($quoteId)
    {

        try {
            $this->sellOrderItems[$this->selectedOrderIndex]["selectedQuote"] = collect($this->sellOrderItems[$this->selectedOrderIndex]["selectedDeviceModel"]["quotes"])->where('id', $quoteId)->first();
            $this->emit('scrollToSection', 'requestFormSection');
        } catch (\Exception $e) {
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
            dd("Something Went Wrong");
        }
    }

    public function addAnotherDevice()
    {

        try {
            $this->setCurrentSellOrderItemAsComplete(true);
            $this->addNewDevice();
        } catch (\Exception $e) {
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
            dd("Something Went Wrong");
        }
    }

    private function addNewDevice(){
        try {
            $this->formVisible = false;
            $this->sellOrderItems[] = $this->getBlankSellOrderItem();
            $this->selectedOrderIndex++;
            $this->emit('scrollToSection', 'deviceSelectionSection');
        } catch (\Exception $e) {
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
            dd("Something Went Wrong", $e);
        }
    }

    public function displayForm()
    {

        try {
            $this->setCurrentSellOrderItemAsComplete(true);
            $this->formVisible = true;
            $this->emit('scrollToSection', 'requestFormSection');

        } catch (\Exception $e) {
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
            dd("Something Went Wrong", $e);
        }
    }

    private function setCurrentSellOrderItemAsComplete($completed) {
        try {
            if($this->sellOrderItems[$this->selectedOrderIndex]["completed"] !== $completed){
                if( $this->sellOrderItems[$this->selectedOrderIndex]["selectedNetworkCarrier"]){
                    $this->sellOrderItems[$this->selectedOrderIndex]["completed"] = $completed;
                    $this->completedSellOrderItems = [];
                    foreach($this->sellOrderItems as $index => $item){
                        if($item["completed"] && array_search($index, $this->completedSellOrderItems) === false){
                            $this->completedSellOrderItems[] = $index;
                        }
                    }
                    $this->setNetTotal();
                }else{
                    $this->removeSellOrder($this->selectedOrderIndex);
                }

                // $this->emit('refreshComponent');
            }
        } catch (\Exception $e) {
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
            dd("Something Went Wrong", $e);
        }

    }

    private function setNetTotal(){
        try {
            $this->netTotal = 0;
            foreach($this->sellOrderItems as $item){
                if($item["selectedQuote"] && $item["completed"]){
                    $this->netTotal += $item["selectedQuote"]["quote_price"];
                }
            }
            $netTotal = $this->netTotal;
            $netTotalComponents = explode(".", sprintf('%0.2f', $netTotal));
            $this->netTotalWhole = $netTotalComponents[0];
            $this->netTotalDecimal = $netTotalComponents[1];

        } catch (\Exception $e) {
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
            dd("Something Went Wrong", $e);
        }


    }

    public function removeSellOrder($sellOrderIndex){
        try {
            unset($this->sellOrderItems[$sellOrderIndex]);
            $indexOfCompleted = array_search($sellOrderIndex, $this->completedSellOrderItems);
            if($indexOfCompleted !== false){
                unset($this->completedSellOrderItems[$indexOfCompleted]);
            }
            $this->selectedOrderIndex--;
            $this->sellOrderItems = array_values($this->sellOrderItems);
            if(count($this->sellOrderItems) === 0){
                $this->addNewDevice();
            }
            $this->setNetTotal();

        } catch (\Exception $e) {
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
            dd("Something Went Wrong", $e);
        }

    }

    public function save()
    {
        try {
            DB::beginTransaction();

            $rules = [
                'firstName' => 'required|string|max:255',
                // 'model_quote_id'=> 'integer',
                'firstName'=> 'required|string|max:255',
                'lastName'=> 'required|string|max:255',
                'email'=> 'required|email|max:255',
                'address'=> 'required|string|max:255',
                'city'=> 'required|string|max:255',
                'province'=> 'required|string|max:255',
                'postalCode'=> 'required|string|max:255',
                'phone'=> 'required|string|max:255',
                'onlyShippingLabel'=> 'required|boolean',
                'paymentMethod'=> 'required|string|max:255',
                'paymentEmail'=> 'required|email|max:255',
                'promoCode'=> 'string|max:255',
            ];

            $this->validate($rules);

            // Create new instance if not found one
            $sellOrder = new SellOrder();

            $sellOrder->fill([
                'firstName' => $this->firstName,
                // 'model_quote_id'=> $this->model_quote_id,
                'firstName'=>  $this->firstName,
                'lastName'=> $this->lastName,
                'email'=> $this->email,
                'address'=> $this->address,
                'city'=> $this->city,
                'province'=> $this->province,
                'postalCode'=> $this->postalCode,
                'phone'=> $this->phone,
                'onlyShippingLabel'=> $this->onlyShippingLabel,
                'paymentMethod'=> $this->paymentMethod,
                'paymentEmail'=> $this->paymentEmail,
                'promoCode'=>  $this->promoCode,
                'netTotal' =>  $this->netTotal,
            ]);

            $sellOrder->save();

            foreach($this->sellOrderItems as $item){
                $sellOrderItem = new SellOrderItem();
                $sellOrderItem->fill([
                    'device_id' => $item["selectedDevice"]["id"],
                    'device_model_id' => $item["selectedDeviceModel"]["id"],
                    'network_carrier_id' => $item["selectedNetworkCarrier"]["id"],
                    'model_quote_id' => $item["selectedQuote"]["id"],
                    'promoCode' => $item["promoCode"],
                ]);
                $sellOrderItem->save();

            }

            DB::commit();

            return redirect()->route('home');

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
        return view('livewire.pages.home', [])->layout('layouts.guest');
    }
}
