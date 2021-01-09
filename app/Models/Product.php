<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\Categoey;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','barcode','brand','category','price','cost_price'];

    public function getcategory()
    {
        return $this->hasOne(Category::class,'id','category');
    }
    public function getbrand()
    {
        return $this->hasOne(Brand::class,'id','brand');
    }
}
