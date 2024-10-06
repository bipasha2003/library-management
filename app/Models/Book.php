<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bookHasCopies()
    {
        return $this->hasMany(BookHasCopies::class,"book_id","id");
        
    }

    public function bookHasPrices()
    {
        return $this->hasMany(BookHasPrice::class,"book_id","id");
        
    }
}
