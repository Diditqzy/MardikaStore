<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            // snapshot seller id
            $table->foreignId('seller_id')->nullable()->constrained('users')->onDelete('set null');
            $table->unsignedInteger('quantity');
            $table->unsignedBigInteger('price'); // snapshot price
            $table->unsignedBigInteger('subtotal')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
