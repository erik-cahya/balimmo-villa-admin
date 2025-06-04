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
            $table->unsignedBigInteger('client_id')->comment('fk to client table');
            $table->date('visit_date');
            $table->string('reference_code')->comment('fk to user table');
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
