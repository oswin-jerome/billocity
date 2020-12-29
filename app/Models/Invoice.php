<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SoldProduct;
use App\Models\Customer;

class Invoice extends Model
{
    use HasFactory;

    public function products(){
        return $this->hasMany(SoldProduct::class,'invoice');
    }
    public function custo(){
        return $this->hasOne(Customer::class,'id','customer');
    }
}
