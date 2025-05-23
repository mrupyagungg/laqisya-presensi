<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranGaji extends Model
{
    protected $table = 'pembayaran_gajis';

      protected $fillable = [
        'id_pegawai',
        'nama_pegawai',
        'jumlah_hadir',
        'potongan',
        'jumlah_gaji',
        'bonus',
        'total',
        'status'
    ];

        public function employee()
    {
        return $this->belongsTo(Group::class, 'id_pegawai');
    }
        public function group()
    {
        return $this->belongsTo(Group::class, 'id_pegawai', 'id');
    }

}