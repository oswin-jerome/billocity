<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['name','phone','email','dob','gst','address'];
    public function invoices(){
        return $this->hasMany(Invoice::class,'customer');
    }

    public function emis(){
        return $this->hasMany(Emi::class);
    }
}
