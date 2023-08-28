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
        Schema::create('attachment_parent_schemas', function (Blueprint $table) {
            $table
                ->integer("parent_id")
                ->unsigned()
                ->index("attachment_parent_id_index", "hash")
                ->nullable();
            $table
                ->foreign("parent_id")
                ->references("id")->on('attachments');

            $table
                ->integer("thumbnail_id")
                ->index("attachment_thumbnail_id_index", "hash")
                ->nullable();
            $table
                ->foreign("thumbnail_id")
                ->references("id")->on('attachments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachment_parent_schemas');
    }
};
