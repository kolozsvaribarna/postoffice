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
        Schema::create('counties', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->collation('utf8mb3_hungarian_ci');

            $table->index('name', 'idx_county_name');
        });

        // The dump's `counties` table uses utf8mb3, while Laravel defaults
        // the table itself to utf8mb4. Force the table charset to match.
        Schema::table('counties', function () {
            \DB::statement('ALTER TABLE `counties` CONVERT TO CHARACTER SET utf8mb3 COLLATE utf8mb3_hungarian_ci');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counties');
    }
};
