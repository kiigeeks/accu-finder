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
        Schema::create('car_variants', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('year_start');
            $table->smallInteger('year_end');
            $table->string('engine')->nullable();
            $table->unsignedBigInteger('model_id');

            $table->foreign('model_id')->references('id')->on('car_models')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_variants');
    }
};
