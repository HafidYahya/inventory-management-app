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
        Schema::create('master_data_assets', function (Blueprint $table) {
            $table->id();
            $table->string("product_code")->unique();
            $table->string("name");
            $table->string("category");
            $table->string("merk");
            $table->enum("unit", ["pcs", "meter", "pack", "box"])->default("pcs");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_data_assets');
    }
};
