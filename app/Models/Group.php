<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_number',
        'nama_pegawai',
        'basic_salary'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function pembayaranGaji()
    {
        return $this->hasMany(PembayaranGaji::class);
    }


}