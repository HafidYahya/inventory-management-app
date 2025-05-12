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
        Schema::table('master_data_assets', function (Blueprint $table) {
            $table->string('epc')->unique()->nullable()->after('product_code');
            $table->integer('initial_quantity')->default(0)->after('unit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_data_assets', function (Blueprint $table) {
            //
        });
    }
};
