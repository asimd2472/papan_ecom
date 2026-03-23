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
        Schema::table('setting', function (Blueprint $table) {
            $table->text('from_address')->nullable()->after('googlemaplink');
            $table->text('from_city')->nullable()->after('from_address');
            $table->text('from_state')->nullable()->after('from_city');
            $table->text('from_zip')->nullable()->after('from_state');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('setting', function (Blueprint $table) {
            //
        });
    }
};
