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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->integer('zip_code');
            $table->string('name', 50)->collation('utf8mb3_hungarian_ci');
            $table->integer('county_id');

            $table->index('zip_code', 'idx_zip_code');
            $table->index('name', 'idx_city');
            $table->index('county_id', 'idx_id_county');
        });

        // Match the dump's utf8mb3 table charset (Laravel defaults to utf8mb4).
        Schema::table('cities', function () {
            \DB::statement('ALTER TABLE `cities` CONVERT TO CHARACTER SET utf8mb3 COLLATE utf8mb3_hungarian_ci');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
