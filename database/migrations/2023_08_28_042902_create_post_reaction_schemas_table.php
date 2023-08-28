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
            'post_reaction_schemas',
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_reaction_schemas');
    }
};
