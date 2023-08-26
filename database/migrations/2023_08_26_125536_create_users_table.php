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
            $table->text('bio');
            $table->timestamp('birth_date');
            $table->enum('gender', ['male', 'female']);
            $table->enum('status', ['active', 'suspended'])->default('active');
            $table->enum('profile_type', ['public', 'private'])->default('public');
            $table->integer('profile_picture');
            $table->integer('cover_photo');
            $table->timestamp('phone_verified_at');
            $table->timestamp('suspended_until');
            $table->integer('suspended_id');
            $table->decimal('latitude');
            $table->decimal('longitude');
            $table->integer('state_id');


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
