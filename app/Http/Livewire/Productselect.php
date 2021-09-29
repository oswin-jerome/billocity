<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Productselect extends Component
{
    public $products  = null;
    public $iteration = 0;

    public function mount()
    {
        $this->products = Product::all();
    }

    public function render()
    {
        return view('livewire.productselect');
    }

    public function fetch(){
        $this->iteration +=1;
        $this->products = Product::all();
        $this->emit('goToPage');
    }
}
