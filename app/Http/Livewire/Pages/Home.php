<?php

namespace App\Http\Livewire\Pages;

use App\Models\Device;
use App\Models\DeviceModel;
use App\Models\DeviceState;
use App\Models\NetworkCarrier;
use App\Models\User;
use Livewire\Component;

class Home extends Component
{
    public $sellOrderItems;
    public $selectedOrderIndex;

    public $devices;
    public $networkCarriers;
    public $formVisible = false;

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

    public function getBlankSellOrderItem(){
        return [
            // "devices" => null,
            // "networkCarriers" => null,
            "selectedDevice" => null,
            "selectedDeviceModel" => null,
            "selectedNetworkCarrier" => null,
            "modelQuotes" => null,
            "selectedQuote" => null,
        ];
    }


    public function mount(){
        $this->devices = Device::with('image')->get();
        $this->networkCarriers = NetworkCarrier::with('image')->get();
        $this->sellOrderItems = [$this->getBlankSellOrderItem()];
        $this->selectedOrderIndex = 0;

    }

    public function selectDevice($deviceId){
        $this->formVisible = false;
        $this->sellOrderItems[$this->selectedOrderIndex]["selectedDeviceModel"] = null;
        $this->sellOrderItems[$this->selectedOrderIndex]["selectedNetworkCarrier"] = null;
        $this->sellOrderItems[$this->selectedOrderIndex]["selectedQuote"] = null;


        $this->sellOrderItems[$this->selectedOrderIndex]["selectedDevice"] = Device::where('id',$deviceId)
                                      ->with('models.image')
                                      ->first()->toArray();
        $this->emit('scrollToSection', 'modelSelectionSection');

    }

    public function selectDeviceModel($deviceModelId){
        $this->formVisible = false;
        $this->sellOrderItems[$this->selectedOrderIndex]["selectedNetworkCarrier"] = null;
        $this->sellOrderItems[$this->selectedOrderIndex]["selectedQuote"] = null;

        $deviceModel = DeviceModel::where('id',$deviceModelId)
                                      ->with('quotes.device_state')
                                      ->first();
        foreach($deviceModel->quotes as $quote){
            $quotePriceComponents = explode(".", $quote->quote_price);
            $quote->quote_price_whole = $quotePriceComponents[0];
            $quote->quote_price_decimal = $quotePriceComponents[1];
        }
        $this->sellOrderItems[$this->selectedOrderIndex]["selectedDeviceModel"] = $deviceModel->toArray();
        if(count($this->sellOrderItems[$this->selectedOrderIndex]["selectedDeviceModel"]["quotes"]) > 0){
            $this->sellOrderItems[$this->selectedOrderIndex]["selectedQuote"] = $this->sellOrderItems[$this->selectedOrderIndex]["selectedDeviceModel"]["quotes"][0];
        }
        $this->emit('scrollToSection', 'networkSelectionSection');

    }

    public function selectNetworkCarrier($networkCarrierId){
        // $this->formVisible = false;
        // if(count($this->sellOrderItems[$this->selectedOrderIndex]["selectedDeviceModel"]["quotes"]) > 0){
        //     $this->sellOrderItems[$this->selectedOrderIndex]["selectedQuote"] = $this->sellOrderItems[$this->selectedOrderIndex]["selectedDeviceModel"]["quotes"][0];
        // }
        $this->sellOrderItems[$this->selectedOrderIndex]["selectedNetworkCarrier"] = $this->networkCarriers->where('id',$networkCarrierId)->first();
        $this->emit('scrollToSection', 'quoteSelectionSection');
    }

    public function selectQuote($quoteId){
        // dd($this->sellOrderItems[$this->selectedOrderIndex]["selectedDeviceModel"]->quotes);
        $this->sellOrderItems[$this->selectedOrderIndex]["selectedQuote"] = collect($this->sellOrderItems[$this->selectedOrderIndex]["selectedDeviceModel"]["quotes"])->where('id',$quoteId)->first();
        $this->emit('scrollToSection', 'requestFormSection');
    }

    public function addAnotherDevice(){
        $this->formVisible = false;
        $this->sellOrderItems[] = $this->getBlankSellOrderItem();
        $this->selectedOrderIndex++;
        $this->emit('scrollToSection', 'deviceSelectionSection');
    }

    public function displayForm(){
        $this->formVisible = true;
        $this->emit('scrollToSection', 'requestFormSection');
    }

    public function save(){
        dd($this->sellOrderItems);
        dd($this->firstName,
        $this->model_quote_id,
        $this->firstName,
        $this->lastName,
        $this->email,
        $this->address,
        $this->city,
        $this->province,
        $this->postalCode,
        $this->phone,
        $this->onlyShippingLabel,
        $this->paymentMethod,
        $this->paymentEmail,
        $this->promoCode,);
    }

    public function render()
    {
        return view('livewire.pages.home', [])->layout('layouts.guest');
    }
}
