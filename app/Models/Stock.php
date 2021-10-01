<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;
use App\Models\Product;


class Stock extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getinvoice()
    {
        return $this->hasOne(Purchase::class,'id','purchase');
    }

    public function getproduct()
    {
        return $this->hasOne(Product::class,'id','product');
    }
}
