<?php

namespace App\Http\Livewire\Pages\Dashboard;

use Livewire\Component;

class Dashboard extends Component
{
    public $title = "Dashboard";
    public function render()
    {
        return view('livewire.pages.dashboard.dashboard');
    }
}
