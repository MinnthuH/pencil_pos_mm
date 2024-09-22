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
        Schema::create('transport_charges', function (Blueprint $table) {
            $table->id();
            $table->integer('sale_id');
            $table->integer('transport_id');
            $table->integer('staff_amount');
            $table->integer('owner_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transport_charges');
    }
};
