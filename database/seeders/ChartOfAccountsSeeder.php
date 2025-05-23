<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChartOfAccountsSeeder extends Seeder
{
    public function run()
    {
        DB::table('chart_of_accounts')->insert([
            [
                'kode_akun' => '1001',
                'nama_akun' => 'Kas',
                'tipe_akun' => 'Aset',
                'keterangan' => 'Uang tunai di tangan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_akun' => '2001',
                'nama_akun' => 'Hutang Usaha',
                'tipe_akun' => 'Kewajiban',
                'keterangan' => 'Utang kepada pemasok',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_akun' => '4001',
                'nama_akun' => 'Pendapatan Jasa',
                'tipe_akun' => 'Pendapatan',
                'keterangan' => 'Pendapatan dari penjualan jasa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_akun' => '5001',
                'nama_akun' => 'Beban Gaji',
                'tipe_akun' => 'Beban',
                'keterangan' => 'Pengeluaran untuk gaji pegawai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}