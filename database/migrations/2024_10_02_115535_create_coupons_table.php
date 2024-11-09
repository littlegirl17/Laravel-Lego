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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name_coupon');
            $table->integer('code')->unique(); // Ràng buộc duy nhất cho mã coupon
            $table->tinyInteger('type');
            $table->decimal('total', 15, 0);
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->decimal('discount', 15, 0);
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
