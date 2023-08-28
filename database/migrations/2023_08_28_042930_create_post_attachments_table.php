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
            'post_attachments',
            function (Blueprint $table) {
                $table->id();

                $table

                    ->integer("post_id")
                    ->unsigned()
                    ->nullable()
                    ->index("post_attachment_post_id_index", "hash");
                $table->foreign("post_id")->references("posts->id")->deferrable("deferred");

                $table
                    ->integer("attachment_id")
                    ->unsigned()
                    ->nullable()
                    ->index("post_attachment_attachment_id_index", "hash");
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
        Schema::dropIfExists('post_attachments');
    }
};
