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

        Schema::create('comment_reply_schema', function (Blueprint $table) {
            $table->integer("comment_id")->unsigned()->nullable();
            $table->foreign("comment_id")->references("comments.id")->deferrable("deferred");
        });
        Schema::create('comment_reaction_schema', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("comment_id")->unsigned()->nullable();
            $table->foreign("comment_id")->references("comments.id")->deferrable("deferred");

            $table->uuid("user_id")->references("users.id")->deferrable("deferred");
        });
        Schema::create('comment_mention_schema', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("comment_id")->unsigned()->nullable();
            $table->foreign("comment_id")->references("comments.id")->deferrable("deferred");

            $table->uuid("user_id")->references("users.id")->deferrable("deferred");
            $table->text("content")->nullable();
            $table->timestamps();
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
