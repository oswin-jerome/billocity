<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use Livewire\Component;

class PurchaseQty extends Component
{

    public $stock;
    public $stockValue;
    public $initialStock;
    public function mount(Stock $stock){
        $this->stock = $stock;
        $this->stockValue = $stock->stock;
        $this->initialStock = $stock->stock;
    }

    public function render()
    {
        return view('livewire.purchase-qty');
    }

    public function changes(){

        $productPrice = $this->stock->getProduct->cost_price;

        // Update stock price and total
        $this->stock->getproduct()->update([
            "stock"=>$this->stock->getproduct->stock + ($this->stockValue - $this->initialStock),
        ]);
        $this->stock->update([
            "stock"=>$this->stockValue,
            "price"=>$productPrice * $this->stockValue,
            "total"=>($productPrice * $this->stockValue) - ($this->stock->discount * ($productPrice* $this->stockValue)/100)
        ]);


        $total = 0;
        // Update purchase total
        foreach ($this->stock->getinvoice->products as $key => $product) {
            
            $total += $product->total;
        }

        $this->stock->getinvoice->total = $total;
        $this->stock->getinvoice->save();
        return redirect(request()->header('Referer'));
    }
}
