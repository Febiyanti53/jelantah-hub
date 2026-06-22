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
    Schema::create('setorans', function (Blueprint $table) {
        $table->id();

        $table->foreignId('masyarakat_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('pengepul_id')->constrained('users')->onDelete('cascade');

        $table->decimal('liter_estimasi', 8, 2);
        $table->date('tanggal_penjemputan');
        
        $table->enum('status', ['pending', 'dijemput', 'selesai', 'ditolak'])->default('pending');

        $table->decimal('liter_bersih', 8, 2)->nullable();
        $table->decimal('endapan', 8, 2)->nullable();
        $table->integer('harga_dibayar')->nullable(); 

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setorans');
    }
};
