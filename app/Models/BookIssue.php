<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookIssue extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function bookIssueHasCopies()
    {
        return $this->hasMany(BookIssueHasCopies::class,"book_issue_id","id")->with("bookHasCopy");
        
    }

    public function cardHolder()
    {
        return $this->hasOne(CardHolder::class,"id","card_holder_id");
    }

    public function books()
    {
        $books = new Collection([]);
        foreach ($this->bookIssueHasCopies as $key => $copy) {
           $books->push($copy->bookHasCopy->book);
        }
        return $books;
    }

   
}
