<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookIssueHasCopies extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function bookHasCopy()
    {
        return $this->belongsTo(BookHasCopies::class,"book_copy_id","id")->with("book");
        
    }
}
