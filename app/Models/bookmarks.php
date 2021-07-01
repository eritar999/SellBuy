<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookmarks extends Model
{
    protected $table = 'bookmarks';
    protected $fillable = ['id','name','postid'];
    public $timestamps = false;
}
