<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmiEntry extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function emi(){
        return $this->belongsTo(Emi::class);
    }

}
