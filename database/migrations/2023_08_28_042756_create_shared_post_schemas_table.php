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
            'shared_post_schemas',
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shared_post_schemas');
    }
};
