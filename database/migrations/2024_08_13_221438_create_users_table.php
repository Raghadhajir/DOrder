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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->string('password');
            $table->string('uuid')->unique();
            $table->foreignId('package_id')->nullable()
            ->references('id')
            ->on('packages')
            ->onDelete('cascade');
            $table->string('profile_image')->nullable();
            $table->integer('subscription_fees')->nullable();
            $table->text('address')->nullable();
            $table->text('notes')->nullable();
            $table->enum('type',['user','deliver','monitor','admin']);
            $table->boolean('active')->default('0');
            $table->date('expire')->nullable();
            $table->foreignId('area_id')->nullable()
            ->references('id')
            ->on('areas')
            ->onDelete('cascade');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
