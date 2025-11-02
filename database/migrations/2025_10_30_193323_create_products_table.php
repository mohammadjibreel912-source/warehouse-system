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
    $table->string('sku')->unique();
    $table->integer('quantity');
    $table->integer('min_quantity');
    $table->date('expiry_date')->nullable();
    $table->decimal('purchase_price', 10, 2)->nullable();
    $table->decimal('sale_price', 10, 2)->nullable();
    $table->foreignId('warehouse_id')->constrained()->onDelete('cascade');
        $table->string('category')->nullable();
    $table->enum('status', ['active', 'expired'])->default('active'); // لمتابعة الصلاحية

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
