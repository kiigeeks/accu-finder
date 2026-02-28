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
        Schema::table('car_variants', function (Blueprint $table) {
            $table->smallInteger('year_start')->nullable()->change();
            $table->smallInteger('year_end')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_variants', function (Blueprint $table) {
            $table->smallInteger('year_start')->nullable(false)->change();
            $table->smallInteger('year_end')->nullable(false)->change();
        });
    }
};
