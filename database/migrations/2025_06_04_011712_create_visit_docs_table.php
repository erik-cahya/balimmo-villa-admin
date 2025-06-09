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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone_number');
            $table->date('visit_date');
            $table->string('reference_code')->comment('fk to user table');
            $table->tinyInteger('status_docs')->comment('0:cancel | 1:Done Visit | 2:Pending');
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
