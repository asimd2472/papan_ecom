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
        Schema::create('producttype', function (Blueprint $table) {
            $table->id();
            $table->string('category_id')->nullable();
            $table->text('typename')->nullable();
            $table->longText('typedesc')->nullable();
            $table->text('typeimage')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producttype');
    }
};
