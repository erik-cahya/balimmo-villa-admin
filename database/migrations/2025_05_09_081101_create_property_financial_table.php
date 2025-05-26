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
        Schema::create('property_financial', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('properties_id')->comment('fk to properties table');
            
            $table->bigInteger('avg_nightly_rate')->nullable();
            $table->decimal('avg_occupancy_rate', 18, 2)->nullable();
            $table->integer('months_rented')->nullable();
            $table->integer('annual_turnover')->nullable();
            // $table->text('document_support')->nullable();

            $table->bigInteger('selling_price_idr')->nullable();
            $table->decimal('selling_price_usd', 18, 2)->nullable();
            $table->bigInteger('commision_ammount_idr')->nullable();
            $table->decimal('commision_ammount_usd', 18, 2)->nullable();
            $table->bigInteger('net_seller_idr')->nullable();
            $table->decimal('net_seller_usd', 18, 2)->nullable();
            $table->timestamps();

            // Foreign Key Constraint with ON DELETE CASCADE
            $table->foreign('properties_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_financial');
    }
};
