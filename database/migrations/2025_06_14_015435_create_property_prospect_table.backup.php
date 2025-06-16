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
        Schema::create('property_prospect', function (Blueprint $table) {
            $table->id();
            $table->string('reference_code')->nullable()->comment('fk to user code');
            $table->string('properties_id')->nullable()->comment('fk to property id');
            $table->string('prospect_first_name')->nullable();
            $table->string('prospect_last_name')->nullable();
            $table->string('prospect_phone_number')->nullable();
            $table->string('prospect_email')->nullable();
            $table->string('prospect_budget')->nullable();
            $table->string('prospect_req_bedroom')->nullable();
            $table->string('prospect_localization')->nullable();
            $table->timestamps();
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
