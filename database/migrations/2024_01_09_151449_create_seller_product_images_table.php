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
        Schema::create('seller_product_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_product_id')->nullable();
            $table->foreign('seller_product_id')->references('id')->on('seller_products')->onDelete('cascade');
            $table->text('front_part')->nullable();
            $table->text('back_part')->nullable();
            $table->text('with_box')->nullable();
            $table->text('with_battery_percentage')->nullable();
            $table->text('with_warrenty')->nullable();
            $table->text('with_model')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_product_images');
    }
};
