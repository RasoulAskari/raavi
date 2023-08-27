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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->increments("id")->index("attachment_id_index", "hash");
            $table->string("url")->index("attachment_url_index", "btree")->notNullable();
            $table->integer("height")->index("attachment_height_index", "hash")->nullable();
            $table->integer("width")->index("attachment_width_index", "hash")->nullable();
            $table->string("duration")->nullable();
            $table->string("mime_type")->index("attachment_mime_type_index", "hash");
            $table->integer("size")->nullable();
            $table->enum("uploaded_by_type", ["admin", "user"]);
            $table->uuid("uploaded_by")->index("attachment_uploaded_by_index", "hash");

            $table->timestamps();
        });
        Schema::create('attachment_parent_schema', function (Blueprint $table) {
            $table
                ->integer("parent_id")
                ->unsigned()
                ->index("attachment_parent_id_index", "hash")
                ->nullable();
            $table
                ->foreign("parent_id")
                ->references("attachments.id")
                ->deferrable("deferred");
            $table
                ->integer("thumbnail_id")
                ->unsigned()
                ->index("attachment_thumbnail_id_index", "hash")
                ->nullable();
            $table
                ->foreign("thumbnail_id")
                ->references("attachments.id")
                ->deferrable("deferred");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
