<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Migration for employees table
    Schema::create('employees', function (Blueprint $table) {
        $table->id(); // auto-increment ID
        $table->string('id_number')->unique(); // id_number field
        $table->string('name');
        $table->string('posisi');
        $table->string('alamat');
        $table->string('jenis_kelamin');
        $table->string('no_telp')->nullable();
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
        Schema::dropIfExists('employees');
    }
}