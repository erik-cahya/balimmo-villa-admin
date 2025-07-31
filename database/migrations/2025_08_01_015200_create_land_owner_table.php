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
        Schema::create('land_owner', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('land_id')->comment('fk to land table');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('owner_order')->nullable();
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
        Schema::dropIfExists('land_owner');
    }
};
