<?php

namespace App\Http\Livewire\Pages\Dashboard\NetworkCarriers;

use Livewire\Component;

class NetworkCarriers extends Component
{
    public $title = "Network Carriers";
    public function render()
    {
        return view('livewire.pages.dashboard.network-carriers.network-carriers');
    }
}
