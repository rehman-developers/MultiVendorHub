<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->onDelete('cascade');
            $table->foreignId('seller_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 8, 2)->default(0.00);
            $table->integer('stock')->default(0);
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Add indexes for better performance
            $table->index('store_id');
            $table->index('category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};