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
            $table->timestamp("deleted_at");
            $table->timestamps(true, true);

            $table->timestamps();
        });

        Schema::create('commentReplySchema', function (Blueprint $table) {
            $table->integer("comment_id")->unsigned()->nullable();
            $table->foreign("comment_id")->references("comments.id")->deferrable("deferred");
        });
        Schema::create('commentReactionSchema', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("comment_id")->unsigned()->nullable();
            $table->foreign("comment_id")->references("comments.id")->deferrable("deferred");

            $table->uuid("user_id")->references("users.id")->deferrable("deferred");
        });
        Schema::create('commentMentionSchema', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("comment_id")->unsigned()->nullable();
            $table->foreign("comment_id")->references("comments.id")->deferrable("deferred");

            $table->uuid("user_id")->references("users.id")->deferrable("deferred");
            $table->text("content")->nullable();
            $table->timestamps(true, true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
