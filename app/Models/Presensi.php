<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = ['id_pegawai', 'status', 'tanggal'];

    protected $dates = ['tanggal'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id_pegawai');
    }

    // Accessor opsional: format tanggal lokal
    public function getTanggalFormattedAttribute()
    {
        return $this->tanggal->format('d-m-Y');
    }
}