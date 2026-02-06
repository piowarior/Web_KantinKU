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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // nullable karena order offline
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->string('order_code')->unique(); // A12, B03
            $table->enum('order_type', ['online', 'offline']);
            $table->enum('status', ['pending', 'processing', 'ready', 'done'])
                  ->default('pending');

            $table->integer('total_price')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
