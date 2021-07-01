<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class queries extends Model
{
    public $primaryKey = 'id';
    protected $table = 'queries';
    public $timestamps = false;
}
