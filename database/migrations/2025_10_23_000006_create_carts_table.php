<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')->constrained('users', 'id')->onDelete('cascade'); // Reference users table
            $table->foreignId('product_id')->constrained('products', 'id')->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamps();

            // Add indexes for better performance
            $table->index('buyer_id');
            $table->index('product_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};