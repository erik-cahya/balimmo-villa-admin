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
        Schema::create('offering_docs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('properties_id')->comment('fk to properties table');
            $table->unsignedBigInteger('client_id')->comment('fk to customer table');
            $table->string('client_passport_number')->nullable();
            $table->string('client_nationality')->nullable();

            $table->bigInteger('idr_price')->nullable();
            $table->decimal('usd_price', 18, 2)->nullable();
            $table->bigInteger('deposit_ammount')->nullable();

            $table->tinyInteger('satisfactory_technical_inspection')->nullable();
            $table->tinyInteger('loan_approval')->nullable();
            $table->tinyInteger('legal_due_diligence')->nullable();
            $table->text('others_contingency')->nullable();

            $table->string('financing_terms')->nullable();
            $table->bigInteger('loan_ammount')->nullable();
            $table->string('bank_name')->nullable();
            $table->date('approval_deadline')->nullable();

            $table->date('offer_validity')->nullable();

            $table->timestamps();

            $table->foreign('properties_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('client')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offering_docs');
    }
};
