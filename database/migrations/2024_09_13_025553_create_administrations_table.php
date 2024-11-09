<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     *  Phương thức này được gọi khi bạn chạy lệnh php artisan migrate
     *  Chứa các lệnh để tạo bảng trong CSDL
     */
    public function up(): void
    {
        Schema::create('administrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_group_id');
            $table->foreign('admin_group_id')->references('id')->on('administration_groups')->onUpdate('restrict')->onDelete('restrict');
            $table->string('fullname');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->longText('image')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Phương thức này được gọi khi bạn chạy lệnh php artisan migrate:rollback
     * Nó chứa các câu lệnh để xóa hoặc khôi phục lại các thay đổi mà phương thức up đã thực hiện
     */
    public function down(): void
    {
        Schema::dropIfExists('administrations'); //Xóa bảng administrations nếu nó tồn tại.
    }
};
