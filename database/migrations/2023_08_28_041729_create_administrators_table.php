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
        Schema::create('administrators', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string("full_name");
            $table->string("email")->unique();
            $table->string("phone_no")->unique();
            $table->string("password");
            $table->timestamp("birth_date")->nullable();
            $table->enum("gender", ["male", "female"]);
            $table->integer("profile_picture")->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrators');
    }
};