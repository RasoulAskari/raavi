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
        Schema::create(
            'user_attachment_schemas',
            function (Blueprint $table) {
                $table
                    ->foreign("profile_picture")
                    ->references("attachments.id")
                    ->deferrable("deferred");
                $table
                    ->foreign("cover_photo")
                    ->references("attachments->id")
                    ->deferrable("deferred");
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_attachment_schemas');
    }
};
