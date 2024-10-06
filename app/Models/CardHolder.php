<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardHolder extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cardHolderHasIntrests()
    {
        return $this->hasMany(CardHolderHasInterst::class,"card_holder_id","id");
        
    }
}
