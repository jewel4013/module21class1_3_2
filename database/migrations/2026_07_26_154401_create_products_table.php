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
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('product_code')->unique();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('set null');
            $table->foreignId('category_id')->constrained('catagories')->onDelete('cascade');
            $table->integer('priority')->nullable()->default(0);
            $table->string('image');
            $table->decimal('product_cost', 10, 2)->nullable()->default(0.00);
            $table->decimal('product_price', 10, 2)->default(0.00);            
            $table->json('multiple_images')->nullable(); 
            $table->text('description')->nullable();
            $table->boolean('status')->default(0);
            $table->boolean('is_popular')->default(0);
            $table->boolean('show_home')->default(0);
            $table->boolean('show_menu')->default(0);
            $table->integer('stock_quantity')->default(0);
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
