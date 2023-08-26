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
            $table->string('full_name');
            $table->string('user_name');
            $table->string('phone_no');
            $table->text('bio')->nullable();
            $table->timestamp('birth_date')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->enum('status', ['active', 'suspended'])->default('active');
            $table->enum('profile_type', ['public', 'private'])->default('public');
            $table->integer('profile_picture')->nullable();
            $table->integer('cover_photo')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamp('suspended_until')->nullable();
            $table->integer('suspended_id')->nullable();
            $table->decimal('latitude', 14, 8);
            $table->decimal('longitude', 14, 8);
            $table->integer('state_id')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
