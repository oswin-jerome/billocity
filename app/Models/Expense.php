<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ExpenseCategory;
class Expense extends Model
{
    use HasFactory;
    protected $fillable = ['amount','category'];

    public function getcategory()
    {
        return $this->hasOne(ExpenseCategory::class,'id','category');
    }
}
