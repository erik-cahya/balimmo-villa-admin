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
        Schema::create('land_financial', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('land_id')->comment('fk to land table');
            $table->string('average_price_status', 5)->nullable();
            $table->bigInteger('avg_nightly_rate')->nullable();
            $table->decimal('avg_occupancy_rate', 18, 2)->nullable();
            $table->string('find_property_of', 10)->nullable();
            $table->string('agent_name')->nullable();
            $table->string('agent_email')->nullable();
            $table->bigInteger('agent_phone')->nullable();
            $table->string('base_price')->nullable();
            $table->bigInteger('desired_price_idr')->nullable();
            $table->decimal('desired_price_usd', 18, 2)->nullable();
            $table->float('agent_commision')->nullable();
            $table->char('give_balimmo_commision', 5)->nullable();
            $table->float('balimmo_commision')->nullable();
            $table->bigInteger('selling_price_idr')->nullable();
            $table->decimal('selling_price_usd', 18, 2)->nullable();

            $table->bigInteger('net_seller_idr')->nullable();
            $table->decimal('net_seller_usd', 18, 2)->nullable();
            // $table->bigInteger('net_seller_idr')->nullable();

            // $table->decimal('net_seller_usd', 18, 2)->nullable();
            $table->timestamps();

            // Foreign Key Constraint with ON DELETE CASCADE
            $table->foreign('land_id')->references('id')->on('land')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lands_financial');
    }
};
