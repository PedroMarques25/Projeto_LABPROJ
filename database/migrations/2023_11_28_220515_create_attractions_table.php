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
        Schema::create('attractions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')
                ->references('id')->on('types')->onDelete('cascade');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')
                ->references('id')->on('cities')->onDelete('cascade');
            $table->string('aboutIt');
            $table->float('price');
            $table->string('attraction_image_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attractions');
    }
};
