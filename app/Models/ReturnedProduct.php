<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ReturnedProduct extends Model
{
    use HasFactory;
    protected $fillable = ['product','invoice','customer','product_price','sold_price','quantity'];
    public function prod(){
        return $this->hasOne(Product::class,'id','product');
    }
}
