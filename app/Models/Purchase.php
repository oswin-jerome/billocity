<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public function getsupplier()
    {
        return $this->hasOne(Supplier::class,'id','supplier');
    }

    public function products(){
        return $this->hasMany(Stock::class,'purchase');
    }
}
