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
            $table->string('name');
            $table->string('slug');
            $table->text('image');
            $table->unsignedBigInteger('category_id'); // Định nghĩa cột category_id
            $table->foreign('category_id') // Tạo ràng buộc khóa ngoại
                ->references('id') // Cột id trong bảng categories
                ->on('categories') // Tên bảng categories
                ->onUpdate('restrict') // Hành động khi cập nhật
                ->onDelete('restrict'); // Hành động khi xóa
            $table->decimal('price', 15, 2); // Cột price không có auto_increment
            $table->integer('view');
            $table->tinyInteger('outstanding')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->text('description');
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
