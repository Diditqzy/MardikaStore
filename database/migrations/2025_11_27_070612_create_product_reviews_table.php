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
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');     // order tertentu
            $table->unsignedBigInteger('order_item_id');// item tertentu
            $table->unsignedBigInteger('product_id');   // produknya
            $table->unsignedBigInteger('user_id');      // buyer
            $table->tinyInteger('rating');              // 1–5
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->unique(['order_item_id', 'user_id']); // hanya 1 review per item
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_reviews');
    }
};
