<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranGaji extends Model
{
    use HasFactory;

    // Menambahkan kolom baru ke dalam $fillable
    protected $fillable = [
        'pegawai_id',      
        'id_pegawai',      
        'nama_pegawai',      
        'jumlah_gaji',     
        'jumlah_hadir',    
        'potongan',        
        'bonus',           
        'total',            
        'tanggal_pembayaran',
    ];

     // Relasi ke Employee (Pegawai)
     public function employee()
     {
         return $this->belongsTo(Employee::class, 'id_pegawai');  // Gunakan 'id_pegawai' yang sesuai dengan nama foreign key
     }

    // Relasi dengan model Group (Jika ada relasi ke grup)
    public function group()
    {
        return $this->belongsTo(Group::class, 'id_number');  // Pastikan 'group_id' ada di tabel pembayaran_gaji
    }
}
