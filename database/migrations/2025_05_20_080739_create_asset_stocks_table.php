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
        Schema::create('asset_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('master_data_assets')->cascadeOnDelete();
            $table->foreignId('location_id')->constrained('master_data_locations')->cascadeOnDelete();
            $table->foreignId('room_id')->constrained('rooms')->cascadeOnDelete();
            $table->integer('quantity')->default(0);
            $table->timestamps();
            // Unik per aset + lokasi + ruangan
            $table->unique(['asset_id', 'location_id', 'room_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_stocks');
    }
};
