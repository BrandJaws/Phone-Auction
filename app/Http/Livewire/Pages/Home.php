<?php

namespace App\Http\Livewire\Pages;

use App\Mail\SellOrderReceived;
use App\Models\Device;
use App\Models\DeviceModel;
use App\Models\DropLocation;
use App\Models\NetworkCarrier;
use App\Models\SellOrder;
use App\Models\SellOrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Home extends Component
{
    public $sellOrderItems = [];
    public $completedSellOrderItems = [];
    public $selectedOrderIndex;

    public $devices;
    public $networkCarriers;
    public $dropLocations;
    public $formVisible = false;
    public $netTotal = 0;
    public $netTotalWhole = 0;
    public $netTotalDecimal = 0;
    public $showSuccessModal = false;

    // Form binding fields
    public $selfDropToLocation = "1";
    public $drop_location_id = "";
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
            $this->dropLocations = DropLocation::all();
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
                ->orderBy('id', 'desc')
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
            if($this->sellOrderItems[$this->selectedOrderIndex]["completed"]){
                $this->setNetTotal();
            }
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
            if($this->selfDropToLocation == '1'){
                $rules = [
                    'drop_location_id'=> 'required',
                    'paymentEmail'=> 'required|email|max:255',
                ];
            }else{
                $rules = [
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
            }

            $this->validate($rules);
            // Create new instance if not found one
            $sellOrder = new SellOrder();
            if($this->selfDropToLocation == '1'){
                $sellOrder->fill([
                    'selfDropToLocation' => 1,
                    'drop_location_id'=>  $this->drop_location_id,
                    'paymentEmail'=> $this->paymentEmail,
                    'promoCode'=>  $this->promoCode ? $this->promoCode : null,
                    'netTotal' =>  $this->netTotal,
                    'status' => SellOrder::STATUSES_SELF_DROP["PROCESSING"]
                ]);
            }else{
                $sellOrder->fill([
                    'selfDropToLocation' => null,
                    'drop_location_id'=>  null,
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
                    'promoCode'=>  $this->promoCode ? $this->promoCode : null,
                    'netTotal' =>  $this->netTotal,
                    'status' => SellOrder::STATUSES_MAIL["PROCESSING"]
                ]);
            }

            $sellOrder->save();
            foreach($this->sellOrderItems as $item){
                $sellOrderItem = new SellOrderItem();
                $sellOrderItem->fill([
                    'sell_order_id' => $sellOrder->id,
                    'device_id' => $item["selectedDevice"]["id"],
                    'device_model_id' => $item["selectedDeviceModel"]["id"],
                    'network_carrier_id' => $item["selectedNetworkCarrier"]["id"],
                    'model_quote_id' => $item["selectedQuote"]["id"],
                    'promoCode' => $item["promoCode"],
                ]);
                $sellOrderItem->save();

            }

            Mail::to($sellOrder->paymentEmail)->send(new SellOrderReceived($sellOrder->id));

            DB::commit();

            $this->showSuccessModal = true;
            // return redirect()->route('home');

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
