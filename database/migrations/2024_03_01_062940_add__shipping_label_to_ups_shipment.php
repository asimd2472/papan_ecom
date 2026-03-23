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
        Schema::table('ups_shipment', function (Blueprint $table) {
            $table->string('product_id')->nullable()->after('order_id');
            $table->string('imageFormat_code')->nullable()->after('trackingNumber');
            $table->longText('graphicImage')->nullable()->after('imageFormat_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ups_shipment', function (Blueprint $table) {
            //
        });
    }
};
