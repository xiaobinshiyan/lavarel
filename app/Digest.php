<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Digest extends Model
{
    protected $table = 'digest';
    protected $fillable = ['content','book_id'];
    // public function book() 
    // {
    // 		return $this->hasOne(Book::class);
    // }
}
