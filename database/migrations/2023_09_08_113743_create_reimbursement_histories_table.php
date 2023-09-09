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
        Schema::create('reimbursement_histories', function (Blueprint $table) {
            $table->foreignId('reimbursement_id');
            $table->text('judul');
            $table->string('karyawan_id', 30);
            $table->dateTime('waktu', $precision = 0);
            $table->enum('jenis_aktifitas', ['Info', 'Persetujuan'])->default('Info');
            $table->text('aktivitas');
            $table->text('keterangan')->nullable();
            $table->enum('warna', ['primary', 'success', 'warning', 'danger', 'info'])->default('info');
            $table->string('icon', 30)->nullable();
            $table->foreign('reimbursement_id')->references('id')->on('reimbursements');
            $table->foreign('karyawan_id')->references('nip')->on('karyawan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reimbursement_histories');
    }
};
