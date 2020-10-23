<?php

namespace App\Http\Livewire\Pages;

use App\Models\Device;
use App\Models\DeviceModel;
use App\Models\NetworkCarrier;
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

    public function getBlankSellOrderItem()
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
            dd("Something Went Wrong");
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
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
            dd("Something Went Wrong");
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
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
            dd("Something Went Wrong");
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
        }
    }

    public function selectNetworkCarrier($networkCarrierId)
    {

        try {
            $this->sellOrderItems[$this->selectedOrderIndex]["selectedNetworkCarrier"] = $this->networkCarriers->where('id', $networkCarrierId)->first();
            $this->emit('scrollToSection', 'quoteSelectionSection');
        } catch (\Exception $e) {
            dd("Something Went Wrong");
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
        }
    }

    public function selectQuote($quoteId)
    {

        try {
            $this->sellOrderItems[$this->selectedOrderIndex]["selectedQuote"] = collect($this->sellOrderItems[$this->selectedOrderIndex]["selectedDeviceModel"]["quotes"])->where('id', $quoteId)->first();
            $this->emit('scrollToSection', 'requestFormSection');
        } catch (\Exception $e) {
            dd("Something Went Wrong");
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
        }
    }

    public function addAnotherDevice()
    {

        try {
            $this->setCurrentSellOrderItemAsComplete(true);
            $this->formVisible = false;
            $this->sellOrderItems[] = $this->getBlankSellOrderItem();
            $this->selectedOrderIndex++;
            $this->emit('scrollToSection', 'deviceSelectionSection');
        } catch (\Exception $e) {
            dd("Something Went Wrong");
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
        }
    }

    public function displayForm()
    {

        try {
            $this->setCurrentSellOrderItemAsComplete(true);
            $this->formVisible = true;
            $this->emit('scrollToSection', 'requestFormSection');

        } catch (\Exception $e) {
            dd("Something Went Wrong", $e);
            \Log::error(__METHOD__, [
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
        }
    }

    private function setCurrentSellOrderItemAsComplete($completed) {
        if($this->sellOrderItems[$this->selectedOrderIndex]["completed"] !== $completed){
            $this->sellOrderItems[$this->selectedOrderIndex]["completed"] = $completed;
            $this->completedSellOrderItems = [];
            foreach($this->sellOrderItems as $index => $item){
                if($item["completed"] && array_search($index, $this->completedSellOrderItems) === false){
                    $this->completedSellOrderItems[] = $index;
                }
            }
            $this->setNetTotal();
            // $this->emit('refreshComponent');
        }

    }

    public function setNetTotal(){
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
    }

    public function save()
    {
        try {
            dd($this->sellOrderItems);
            dd(
                $this->firstName,
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
                $this->promoCode,
            );
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
        return view('livewire.pages.home', [])->layout('layouts.guest');
    }
}
