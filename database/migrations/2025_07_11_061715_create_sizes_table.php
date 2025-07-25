<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();            // BIGINT UNSIGNED
            $table->string('name')   // Ví dụ: 'S','M','L','XL','XXL'
                  ->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sizes');
    }
};
