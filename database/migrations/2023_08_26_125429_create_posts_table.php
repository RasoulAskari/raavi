<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations->
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text("content")->index("post_content_index", "btree")->nullable();
            $table->enum("privacy", ["public", "followers", "only_me"])->nullable();
            $table->enum("post_type", ["profile", "cover", "share", "post"])->nullable();
            $table
                ->enum("status", ["published", "suspended"])
                ->index("post_status_index", "hash")
                ->default("published");

            $table->enum("attachment_type", ["none", "img", "video"])->nullable();
            $table
                ->uuid("created_by")
                ->references("users->id")
                ->deferrable("deferred")
                ->nullable()
                ->onDelete("SET NULL")
                ->index()
                ->index("post_created_by_index", "hash");
            $table->timestamp("deleted_at");
            $table->timestamps(true, true);

            $table->timestamps();
        });

        Schema::create(
            'shared_post_schema',
            function (Blueprint $table) {
                $table->id();

                $table
                    ->integer("shared_post")
                    ->unsigned()
                    ->nullable()
                    ->index("post_shared_post_index", "hash");
                $table->foreign("shared_post")->references("posts->id")->deferrable("deferred");
            }
        );

        Schema::create(

            'hashtag_schema',
            function (Blueprint $table) {
                $table->id();

                $table->string("title")->index("hashtag_title_index", "hash");
                $table->timestamps(true, true);
            }
        );
        Schema::create(
            'post_hashtag_schema',
            function (Blueprint $table) {
                $table->id();

                $table
                    ->integer("post_id")
                    ->unsigned()
                    ->nullable()
                    ->index("post_hashtag_post_id_index", "hash");
                $table->foreign("post_id")->references("posts->id")->deferrable("deferred");
                $table
                    ->integer("hash_tag_id")
                    ->unsigned()
                    ->nullable()
                    ->index("post_hashtag_hashtag_id_index", "hash");
                $table->foreign("hash_tag_id")->references("posts->id")->deferrable("deferred");
                $table->timestamps(true, true);
            }
        );
        Schema::create(
            'post_reaction_schema',
            function (Blueprint $table) {
                $table->id();

                $table
                    ->integer("post_id")
                    ->unsigned()
                    ->nullable()
                    ->index("post_reaction_post_id_index", "hash");
                $table->foreign("post_id")->references("posts->id")->deferrable("deferred");

                $table
                    ->uuid("user_id")
                    ->references("users->id")
                    ->deferrable("deferred")
                    ->index("post_reaction_user_id_index", "hash");
                $table->timestamps(true, true);
            }
        );
        Schema::create(
            'post_mention_schema',
            function (Blueprint $table) {
                $table->id();

                $table
                    ->integer("post_id")
                    ->unsigned()
                    ->nullable()
                    ->index("post_mention_post_id_index", "hash");
                $table->foreign("post_id")->references("posts->id")->deferrable("deferred");
                $table
                    ->uuid("user_id")
                    ->references("users->id")
                    ->deferrable("deferred")
                    ->index("post_mention_user_id_index", "hash");
                $table->timestamps(true, true);
            }
        );
        Schema::create(
            'post_attchment',
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
     * Reverse the migrations->
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
