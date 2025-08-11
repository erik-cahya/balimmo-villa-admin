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
        Schema::create('visit_land_docs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('docs_visit_id')->unsigned()->index()->nullable();
            $table->foreign('docs_visit_id')->references('id')->on('visit_docs')->onDelete('cascade');

            $table->bigInteger('land_id')->unsigned()->index()->nullable();
            $table->foreign('land_id')->references('id')->on('land')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visit_land_docs');
    }
};
