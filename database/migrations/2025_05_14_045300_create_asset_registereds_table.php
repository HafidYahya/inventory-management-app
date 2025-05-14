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
        Schema::create('asset_registereds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('master_data_asset_id')->constrained('master_data_assets')->cascadeOnDelete();
            $table->string('epc')->unique()->nullable(); // dari RFID
            $table->string('note')->nullable();
            $table->integer('default_quantity')->default(1);
            $table->boolean('is_registered')->default(false); // sudah distok in atau belum
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_registereds');
    }
};
