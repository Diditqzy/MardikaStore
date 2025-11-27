<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');
            // optional single-seller assumption: store seller id (if multi-seller you can omit)
            $table->foreignId('seller_id')->nullable()->constrained('users')->onDelete('set null');
            $table->unsignedBigInteger('total_price')->default(0);
            $table->string('name');
            $table->string('phone');
            $table->text('address');
            $table->text('notes')->nullable();
            $table->enum('status', ['pending','packed','shipped','completed','cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
