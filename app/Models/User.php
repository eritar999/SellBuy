<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;



    protected $table = 'user';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'vardas',
        'pavarde',
        'profilio_nuotrauka',
        'lytis',
        'salis',
        'issilavinimas',
        'gimimo_data',
        'profesija',
        'politines_paziuros',
        'kiek_stumi',
        'masina',
        'megstamiausias_gyvunas',
        'apie'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function skelbimai()
    {
        return $this->hasMany('App\Models\skelbimas','fk_Naudotojasid', 'id');
    }
    public function komentarai()
    {
        return $this->hasMany('App\Models\komentaras','fk_Naudotojasid','id');
    }
}
