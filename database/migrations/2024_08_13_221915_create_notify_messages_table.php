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
        Schema::create('notify_messages', function (Blueprint $table) {
            $table->id();
            $table->text('message');
            $table->foreignId('order_id')
            ->references('id')
            ->on('orders')
            ->onDelete('cascade');
            $table->foreignId('from_user')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->foreignId('to_user')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->string('image_url');
            $table->boolean('IsVoise');
            $table->string('VoiseURL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notify_messages');
    }
};
