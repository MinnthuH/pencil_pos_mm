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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->integer('category_id');
            $table->integer('supplier_id');
            $table->string('porduct_code');
            $table->string('product_garage')->nullable();
            $table->string('product_image')->nullable();
            $table->integer('product_store')->nullable();
            $table->string('buying_date')->nullable();
            $table->string('expire_date')->nullable();
            $table->integer('buy_price')->nullable();
            $table->integer('selling_price')->nullable();
            $table->integer('unit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
