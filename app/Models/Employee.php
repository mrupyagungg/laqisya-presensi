<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_number',
        'name',
        'posisi',
        'alamat',
        'jenis_kelamin',
        'no_telp'
    ];


    public function pembayaranGaji()
{
    return $this->hasMany(PembayaranGaji::class, 'id');
}


}