<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_cart_items_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->foreignId('product_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->integer('quantity')->default(1);
            $table->timestamps();
            
            $table->unique(['cart_id','product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
