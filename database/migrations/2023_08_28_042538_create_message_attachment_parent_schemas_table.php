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
        Schema::create('message_attachment_parent_schemas', function (Blueprint $table) {
            $table
                ->integer("parent_id")
                ->unsigned()
                ->index("message_attachment_parent_id_index", "hash")
                ->nullable();
            $table
                ->foreign("parent_id")
                ->references("message_attachments.id")
                ->deferrable("deferred");
            $table
                ->integer("thumbnail_id")
                ->unsigned()
                ->index("message_attachment_thumbnail_id_index", "hash")
                ->nullable();
            $table
                ->foreign("thumbnail_id")
                ->references("message_attachments.id")
                ->deferrable("deferred");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_attachment_parent_schemas');
    }
};
