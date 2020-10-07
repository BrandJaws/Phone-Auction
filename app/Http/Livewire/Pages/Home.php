<?php

namespace App\Http\Livewire\Pages;

use App\Models\User;
use Livewire\Component;

class Home extends Component
{
    public $count = 0;
    public $myVal = "";

    public function increment(){
        $this->count++;
    }

    public function decrement(){
        $this->count--;
    }

    public function render()
    {
        $user = User::find($this->myVal);
        return view('livewire.pages.home', ["user"=>$user])->layout('layouts.guest');
    }
}
