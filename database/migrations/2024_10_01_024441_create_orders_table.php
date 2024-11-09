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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('restrict')->onDelete('restrict');
            $table->string('name');
            $table->string('email');
            $table->integer('phone');
            $table->string('province');
            $table->string('district');
            $table->string('ward');
            $table->decimal('total', 15, 0);
            $table->tinyInteger('payment');
            $table->tinyInteger('status');
            $table->integer('coupon_code')->nullable();
            $table->string('order_code');
            $table->string('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
