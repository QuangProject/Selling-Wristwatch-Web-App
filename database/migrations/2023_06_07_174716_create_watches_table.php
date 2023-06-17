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
        Schema::create('watches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('collection_id');
            $table->string('model')->unique();
            $table->decimal('original_price');
            $table->decimal('selling_price');
            $table->integer('discount');
            $table->string('gender');
            $table->string('case_material');
            $table->integer('case_diameter');
            $table->integer('case_thickness');
            $table->string('strap_material');
            $table->string('dial_color');
            $table->string('crystal_material');
            $table->integer('water_resistance');
            $table->string('movement_type');
            $table->integer('power_reserve');
            $table->string('complications');
            $table->boolean('availability');
            $table->timestamps();

            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('watches');
    }
};
