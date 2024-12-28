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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->integer('quantity');
            $table->double('price');
            $table->double('total');
            $table->foreignId('delivary_id')
            ->references('id')
            ->on('deliveries')
            ->onDelete('cascade');
            $table->foreignId('order_id')
            ->references('id')
            ->on('orders')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
