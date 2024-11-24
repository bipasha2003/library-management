<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookIssue extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function bookIssueHasCopies()
    {
        return $this->hasMany(BookIssueHasCopies::class,"book_issue_id","id");
        
    }

    public function book()
    {
        return $this->belongsTo(BookIssue::class);
        
    }
}
