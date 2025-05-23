<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Average extends Model
{
    use HasFactory;

    protected $fillable = [
        'ptkp_status',
        'bruto_min',
        'bruto_max',
        'tarik_pct',
        'golongan',
    ];
}