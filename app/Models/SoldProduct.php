<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class SoldProduct extends Model
{
    use HasFactory;
    public function prod(){
        return $this->hasOne(Product::class,'id','product');
    }
}
