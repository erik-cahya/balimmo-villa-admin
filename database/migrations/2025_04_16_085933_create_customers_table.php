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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('properties_id')->comment('fk to properties table');
            $table->string('agent_code')->nullable();
            $table->string('cust_name');
            $table->string('cust_telp');
            $table->string('cust_email');
            $table->integer('cust_budget')->nullable();
            $table->integer('require_bedroom')->nullable();
            $table->string('localization')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
