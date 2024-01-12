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
            $table->text('front_photo')->nullable();
            $table->text('back_photo')->nullable();
            $table->text('photo_with_box')->nullable();
            $table->text('photo_with_battery_percentage')->nullable();
            $table->text('photo_with_warrenty')->nullable();
            $table->text('photo_with_model')->nullable();
            $table->text('photo_with_serial_no')->nullable();
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
