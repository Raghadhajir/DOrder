<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->text('order');
            $table->unsignedBigInteger('order_number')->default('0');
            $table->enum('status', ['completed', 'inProgress', 'waiting']);
            $table->string('uuid')->unique();
            $table->foreignId('delivary_id')->nullable()
                ->references('id')
                ->on('deliveries')
                ->onDelete('cascade');
            $table->timestamp('scheduledTime')->nullable();
            $table->string('estimatedTime')->nullable();
            $table->text('adress');
            $table->string('startDelivaryTime')->nullable();
            $table->string('receivedTime')->nullable();
            $table->boolean('canceled')->nullable();
            $table->string('cancelNote')->nullable();
            $table->foreignId('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->integer('rate')->nullable();
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
