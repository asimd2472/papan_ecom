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
        Schema::table('product', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->after('category_id')->nullable();
            $table->unsignedBigInteger('brand_id')->after('type_id')->nullable();
            $table->unsignedBigInteger('created_by')->after('product_offerprice')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn('type_id');
            $table->dropColumn('brand_id');
            $table->dropColumn('created_by');
        });
    }
};
