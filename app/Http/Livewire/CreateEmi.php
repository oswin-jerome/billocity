<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Invoice;
use Livewire\Component;

class CreateEmi extends Component
{
    public $customers = null;
    public $invoices = [];
    public $customer = null;
    // public $invoice = null;
    public $amount = 0;
    public $down_payment = 0;
    public $period = 0;
    public $interest_rate = 0;
    public $interval = "monthly";
    public $totalEmi = 0;
    public function mount()
    {
        $this->customers = Customer::all();
    }
    public function render()
    {
        $this->totalEmi = ($this->amount - $this->down_payment) + (($this->amount - $this->down_payment) * ($this->interest_rate / 100));
        return view('livewire.create-emi');
    }

    public function selectCustomer($val){
        $temp = Customer::find($val);
        $this->invoices = $temp->invoices;
        $this->amount = 0;
        $this->down_payment = 0;
        $this->period = 0;
        $this->interest_rate = 0;
        $this->interval = "monthly";
        $this->totalEmi = 0;
    }

    public function selectInvoice($val){
        $temp = Invoice::find($val);
        $this->amount = $temp->final_price;
    }

    public function calculate(){

    }
}
