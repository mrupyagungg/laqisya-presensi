<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranGajisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_gajis', function (Blueprint $table) {
            $table->id();
            $table->string('id_pegawai');
            $table->string('nama_pegawai'); // Added this field
            $table->decimal('jumlah_gaji', 15, 2);
            $table->integer('jumlah_hadir'); // Added this field
            $table->decimal('potongan', 15, 2)->default(0); // Added this field
            $table->decimal('bonus', 15, 2)->default(0); // Added this field
            $table->decimal('total', 15, 2); // Added this field for total
            $table->timestamp('tanggal_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran_gajis');
    }
}
