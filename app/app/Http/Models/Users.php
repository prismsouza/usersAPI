<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";
    protected $fillable = [
        'name',
        'number',
        'is_active',
        'rg',
        'cpf',
        'is_accredited',
        'driver_category',
        'gender',
        'birth_date',
        'inclusion_date',
        'quadro',
        'posto/grad',
        'functional_situation',
        'unity',
        'unity_code',
        'main_unity',
        'main_unity_code',
        'pilot_license_category',
        'rerecadastration_date',
        'last_update'
    ];

    protected $casts = [
        'date' => 'Timestamp'
    ];
}