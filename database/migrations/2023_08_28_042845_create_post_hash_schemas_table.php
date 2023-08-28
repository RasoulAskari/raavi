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
            'post_hash_schemas',
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_hash_schemas');
    }
};
