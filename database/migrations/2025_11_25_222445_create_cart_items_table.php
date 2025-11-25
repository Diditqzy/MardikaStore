<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('quantity')->default(1);
            $table->unsignedBigInteger('price'); // snapshot price at time added
            $table->timestamps();

            $table->unique(['cart_id', 'product_id']); // satu product hanya satu baris per cart
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
};
