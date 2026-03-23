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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->index();
            $table->foreign('category_id')->references('id')->on('productcategory')->onDelete('cascade')->onUpdate('cascade');
            $table->text('product_title');
            $table->text('product_slug');
            $table->longText('product_desc')->nullable();
            $table->string('product_price')->nullable();
            $table->string('product_offerprice')->nullable();
            $table->enum('status', ['1', '0'])->default('1');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
