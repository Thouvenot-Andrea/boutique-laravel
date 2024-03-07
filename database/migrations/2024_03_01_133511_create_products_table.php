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

            $table->uuid('id')->primary();
            $table->string('picture');
            $table->string('name');
            $table->string('description');
            $table->integer('weight');
            $table->integer('stock');
            $table->integer('TTC_price');
            $table->integer('HT_price');
            $table->integer('VAT');
            $table->timestamps();
            $table->foreignUuid('category_id')->constrained();
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
