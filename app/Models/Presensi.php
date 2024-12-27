<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = ['id_pegawai', 'status', 'tanggal'];

    // Relasi dengan model Employee
    // Di dalam model Presensi
public function employee()
{
    return $this->belongsTo(Employee::class, 'id_pegawai');
}


    // Format tanggal jika diperlukan
    protected $dates = ['tanggal'];

    
}
