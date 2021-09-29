<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function customer(){
        return $this->hasOne(Customer::class,"id","customer_id");
    }

    public function emi_entries(){
        return $this->hasMany(EmiEntry::class,"emi_id","id");
    }

    

}
