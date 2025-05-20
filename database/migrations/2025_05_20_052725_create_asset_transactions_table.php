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
        Schema::create('asset_transactions', function (Blueprint $table) {
            $table->id();
            // relasi ke assets master data assets 
            $table->foreignId('asset_id')->nullable()->constrained('master_data_assets')->nullOnDelete();
            // relasi ke assets_registered (untuk stok in dari register)
            $table->foreignId('registered_asset_id')->nullable()->constrained('asset_registereds')->nullOnDelete();
            // relasi ke master lokasi & ruangan
            $table->foreignId('location_id')->nullable()->constrained('master_data_locations')->nullOnDelete();
            $table->foreignId('room_id')->nullable()->constrained('rooms')->nullOnDelete();
            // jenis transaksi
            $table->enum('type', ['in', 'out']);
            // alasan khusus untuk stok out (relasi ke master data alasan stok out)
            $table->foreignId('stock_out_reason_id')->nullable()->constrained('stock_out_reasons')->nullOnDelete();
            // jumlah
            $table->integer('quantity');
            // alasan tambahan atau catatan (khusus jika alasan = Dipakai Project/Dijual)
            $table->string('reason')->nullable();
            // relasi ke user login
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_transactions');
    }
};
