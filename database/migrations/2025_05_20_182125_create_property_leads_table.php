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
        Schema::create('property_leads', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('properties_id')->nullable()->comment('fk to properties table');
            $table->string('agent_code')->nullable();
            $table->string('cust_name');
            $table->string('cust_telp');
            $table->string('cust_email');
            $table->bigInteger('cust_budget')->nullable();
            $table->integer('require_bedroom')->nullable();
            $table->string('localization')->nullable();
            $table->date('date')->nullable();
            $table->text('message')->nullable();
            $table->boolean('prospect_status')->comment('1 : True/Prospect | 0 : False');
            $table->tinyInteger('docs_status')->comment('0 : Decline | 1 : Visit | 2 : Offering')->nullable();
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
        Schema::dropIfExists('property_leads');
    }
};
