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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table
                ->integer("post_id")
                ->index("comment_post_id_index", "hash")
                ->unsigned()
                ->nullable();
            $table
                ->foreign("post_id")
                ->references("posts.id")
                ->deferrable("deferred")
                ->onDelete("SET NULL");
            $table
                ->uuid("user_id")
                ->index("comment_user_id_index", "hash")
                ->references("users.id")
                ->deferrable("deferred")
                ->nullable()
                ->onDelete("SET NULL");
            $table->text("content")->index("comment_content_index", "btree");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_schemas');
    }
};
