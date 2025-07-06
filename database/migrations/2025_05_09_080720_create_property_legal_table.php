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
        Schema::create('property_legal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('properties_id')->comment('fk to properties table');
            $table->string('company_name')->nullable();
            $table->string('rep_first_name')->nullable()->comment('representative first name');
            $table->string('rep_last_name')->nullable()->comment('representative last name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('legal_status')->comment('Freehold/Leasehold');
            $table->string('holder_name')->nullable()->comment('certificate/contract name');
            $table->string('holder_number')->nullable()->comment('certificate/contract number');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('extension_cost')->nullable();
            $table->string('purchase_cost')->nullable();
            $table->date('deadline_payment')->nullable();
            $table->string('zoning')->nullable();
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
        Schema::dropIfExists('property_legal');
    }
};
