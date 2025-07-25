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
            $table->string('name');                // Tên sản phẩm
            $table->text('description')->nullable(); // Mô tả
            $table->decimal('price', 10, 2);        // Giá, ví dụ: 12345678.99
            $table->integer('stock_quantity')->default(0); // Số lượng tồn kho

            // Khóa ngoại liên kết đến bảng categories
            $table->foreignId('category_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Khóa ngoại liên kết đến bảng sizes
            $table->foreignId('size_id')
                  ->constrained('sizes')
                  ->cascadeOnDelete();

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
