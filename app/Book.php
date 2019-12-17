<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';
    protected $fillable = ['name','sort','author'];
    public function digest()
		{
    	return $this->hasMany(Digest::class);
		}
}
