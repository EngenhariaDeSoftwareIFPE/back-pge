<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Signatory extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'matricula',
        'nome',
        'idCargo',
        'curso',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'id',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'idCargo', 'idCargo');
    }
}
