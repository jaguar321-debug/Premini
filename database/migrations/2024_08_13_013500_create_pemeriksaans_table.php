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
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hewan_id');
            $table->unsignedBigInteger('dokter_id');
            $table->unsignedBigInteger('tanggal_pemeriksaan_id');
            $table->string('jenis_perawatan');
            $table->boolean('vaksin');
            $table->decimal('harga', 10, 2);
            $table->text('deskripsi');
            $table->foreign('tanggal_pemeriksaan_id')->references('id')->on('jadwals')->onDelete('cascade');
            $table->foreign('hewan_id')->references('id')->on('hewans')->onDelete('cascade');
            $table->foreign('dokter_id')->references('id')->on('dokters')->onDelete('cascade');
            $table->timestamps();
        });     
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaans');
    }
};
