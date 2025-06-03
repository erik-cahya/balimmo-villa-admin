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
        Schema::create('visit_docs', function (Blueprint $table) {
            $table->id();
            $table->text('name_docs');
            $table->unsignedBigInteger('user_id')->comment('fk to user table');
            $table->date('visit_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visit_docs');
    }
};
