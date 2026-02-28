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
        Schema::create('battery_compabilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('battery_id');
            $table->unsignedBigInteger('variant_id');

            $table->foreign('battery_id')->references('id')->on('batteries')->onDelete('cascade');
            $table->foreign('variant_id')->references('id')->on('car_variants')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('battery_compabilities');
    }
};
