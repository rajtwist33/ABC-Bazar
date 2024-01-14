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
        Schema::create('seller_products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code')->nullable();
            $table->string('model')->nullable();
            $table->string('storage')->nullable();
            $table->string('warenty_left')->nullable();
            $table->string('battery_percentage')->nullable();
            $table->enum('woking_properly', ['yes', 'no'])->nullable();
            $table->enum('original_screen', ['yes', 'no'])->nullable();
            $table->enum('phone_unopened', ['yes', 'no'])->nullable();
            $table->enum('battery_original', ['yes', 'no'])->nullable();
            $table->enum('mdms_registered', ['yes', 'no'])->nullable();
            $table->enum('defect', ['yes', 'no'])->nullable();
            $table->text('defect_description')->nullable();
            $table->enum('mobile_condition', ['Good', 'Average','Below-Average'])->nullable();
            $table->enum('approved_status', ['pending', 'approved','rejected'])->default('pending');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade');
            $table->text('slug')->nullable();
            $table->text('slug_display')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_products');
    }
};
