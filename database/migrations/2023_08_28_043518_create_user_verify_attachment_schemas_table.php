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
            'user_verify_attachments_schemas',
            function (Blueprint $table) {
                $table->id();
                $table->uuid("user_id")->nullable()->index("user_verify_user_id_index", "hash");
                $table->foreign("user_id")->references("users.id")->deferrable("deferred");
                $table->integer("attachment_id")->unsigned()->nullable();
                $table
                    ->foreign("attachment_id")
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
        Schema::dropIfExists('user_verify_attachment_schemas');
    }
};
