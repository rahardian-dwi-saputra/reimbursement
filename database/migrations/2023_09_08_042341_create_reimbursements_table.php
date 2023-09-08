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
        Schema::create('reimbursements', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_pengajuan');
            $table->string('dokumen')->nullable();
            $table->enum('status', ['draft', 'pengajuan', 'disetujui','selesai'])->default('draft');
            $table->string('bukti_pembayaran')->nullable();
            $table->string('diajukan_oleh', 30);
            $table->timestamps();

            $table->foreign('diajukan_oleh')->references('nip')->on('karyawan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reimbursements');
    }
};
