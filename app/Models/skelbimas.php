<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use App\Filters\ProductFilter;


class skelbimas extends Model
{
    public $primaryKey = 'skelbimoNr';
    public $timestamps = false;
    public $table = "post";
    public function kategorija(){
        return $this->belongsTo('App\Models\kategorija','fk_KategorijakategorijosNr','kategorijosNr');
    }  
    public function autorius(){
        return $this->belongsTo('App\Models\User','fk_Naudotojasid','id');
    }

}
