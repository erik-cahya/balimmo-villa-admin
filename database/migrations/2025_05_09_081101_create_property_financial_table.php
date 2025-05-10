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
            $table->foreignId('properties_id')->comment('fk to properties table');
            
            $table->float('avg_nightly_rate');
            $table->float('avg_occupancy_rate');
            $table->integer('months_rented');
            $table->float('annual_turnover');
            $table->text('document_support');

            $table->integer('selling_price_idr');
            $table->float('selling_price_usd');
            $table->integer('commision_ammount_idr');
            $table->float('commision_ammount_usd');
            $table->integer('net_seller_idr');
            $table->float('net_seller_usd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_rental_price');
    }
};
