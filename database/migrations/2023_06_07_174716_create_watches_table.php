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
            $table->string('name')->unique();
            $table->string('model');
            $table->decimal('price');
            $table->integer('stock');
            $table->string('gender');
            $table->string('case_material');
            $table->decimal('case_diameter');
            $table->decimal('case_thickness');
            $table->string('strap_material');
            $table->string('dial_color');
            $table->boolean('water_resistance');
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
