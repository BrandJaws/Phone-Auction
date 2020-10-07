<?php

namespace App\Http\Livewire\Pages\Dashboard\NetworkCarriers;

use Livewire\Component;

class EditNetworkCarrier extends Component
{
    public $title = "Edit Network Carrier";
    public function render()
    {
        return view('livewire.pages.dashboard.network-carriers.edit-network-carrier');
    }
}
