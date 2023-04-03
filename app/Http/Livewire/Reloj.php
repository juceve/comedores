<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Reloj extends Component
{
    public $relojServer="";
    
    public function mount(){
        $this->relojServer = date('Y-m-d H:i:s');
    }

    public function render()
    {
        return view('livewire.reloj');
    }

    protected $listeners = ['reloj'];

    public function reloj(){        
        $this->relojServer = date('Y-m-d H:i:s');
    }
}
