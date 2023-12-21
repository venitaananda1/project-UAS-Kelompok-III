<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string ('nama_pasien');
            $table->string ('umur_pasien');
            $table->string ('jenis_kelamin'); 
            $table->text ('alamat'); 
            $table->string ('no_kontak'); 
            $table->unsignedInteger ('dokter_id'); //field dari tabel dokter
            $table->unsignedInteger ('obat_id'); //field dari tabel obat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
