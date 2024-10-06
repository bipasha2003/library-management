<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardHolderHasInterst extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cardHolder()
    {
        return $this->belongsTo(CardHolder::class);
        
    }
}
