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
        Schema::create('ups_shipment', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->string('transactionIdentifier')->nullable();
            $table->string('shipmentIdentificationNumber')->nullable();
            $table->string('trackingNumber')->nullable();
            $table->string('current_status')->nullable();
            $table->longText('json_responce')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ups_shipment');
    }
};
