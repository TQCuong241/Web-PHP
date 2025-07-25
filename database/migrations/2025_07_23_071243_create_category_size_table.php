<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('category_size', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('size_id');

            $table->foreign('category_id')
                  ->references('id')->on('categories')
                  ->cascadeOnDelete();
            $table->foreign('size_id')
                  ->references('id')->on('sizes')
                  ->cascadeOnDelete();

            $table->primary(['category_id', 'size_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_size');
    }
};
