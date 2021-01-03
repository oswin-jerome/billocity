<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;
use App\Models\Product;


class Stock extends Model
{
    use HasFactory;

    public function getsupplier()
    {
        return $this->hasOne(Supplier::class,'id','supplier');
    }

    public function getproduct()
    {
        return $this->hasOne(Product::class,'id','product');
    }
}
