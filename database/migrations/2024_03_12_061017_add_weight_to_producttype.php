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
        Schema::table('producttype', function (Blueprint $table) {
            $table->string('length')->nullable()->after('typeimage');
            $table->string('width')->nullable()->after('length');
            $table->string('height')->nullable()->after('width');
            $table->string('weight')->nullable()->after('height');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('producttype', function (Blueprint $table) {
            //
        });
    }
};
