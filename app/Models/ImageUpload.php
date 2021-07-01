<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageUpload extends Model
{
    protected $table = 'imageuploads';
    protected $fillable = ['id','business_name','business_imgs'];
    public $timestamps = false;
}
