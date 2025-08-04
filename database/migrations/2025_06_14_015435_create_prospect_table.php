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
        Schema::create('prospect', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('properties_id')->nullable()->comment('fk to properties table');
            $table->unsignedBigInteger('land_id')->nullable()->comment('fk to land table');
            $table->unsignedBigInteger('customer_id')->nullable()->comment('fk to customer data table');
            $table->char('type_asset', 10)->nullable();

            $table->bigInteger('min_budget_idr')->nullable();
            $table->bigInteger('max_budget_idr')->nullable();

            $table->decimal('min_budget_usd', 18, 2)->nullable();
            $table->decimal('max_budget_usd', 18, 2)->nullable();

            $table->integer('min_bedroom')->nullable();
            $table->integer('max_bedroom')->nullable();

            $table->float('min_land_size')->nullable();
            $table->float('max_land_size')->nullable();

            $table->string('localization')->nullable();
            $table->date('date')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();

            $table->foreign('properties_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('land_id')->references('id')->on('land')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_prospect');
    }
};
