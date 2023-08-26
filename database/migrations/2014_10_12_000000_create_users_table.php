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
            $table->string('birth_date');
            $table->string('gender');
            $table->string('status');
            $table->string('profile_type');
            $table->string('profile_picture');
            $table->string('cover_photo');
            $table->string('phone_verified_at');
            $table->string('suspended_until');
            $table->string('suspended_id');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('state_id');
            $table->string('longitude');


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
