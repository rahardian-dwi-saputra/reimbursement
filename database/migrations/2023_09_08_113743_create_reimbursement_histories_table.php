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
            $table->string('karyawan', 30);
            $table->dateTime('waktu', $precision = 0);
            $table->text('aktivitas');
            $table->enum('status', ['Tolak', 'Setuju'])->nullable();
            $table->text('keterangan')->nullable();

            $table->foreign('karyawan')->references('nip')->on('karyawan');
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
