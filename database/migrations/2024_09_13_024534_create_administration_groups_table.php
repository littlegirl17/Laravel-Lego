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
        Schema::create('administration_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('permission');
            $table->timestamps();
        });
    }

    /**
     * Phương thức này được gọi khi bạn chạy lệnh php artisan migrate:rollback
     * Nó chứa các câu lệnh để xóa hoặc khôi phục lại các thay đổi mà phương thức up đã thực hiện
     */
    public function down(): void
    {
        Schema::dropIfExists('administration_groups');
    }
};
