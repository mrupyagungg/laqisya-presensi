<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranGaji extends Model
{
    use HasFactory;

    protected $fillable = ['pegawai_id', 'jumlah_gaji', 'tanggal_pembayaran'];

    // Relasi dengan model Pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}