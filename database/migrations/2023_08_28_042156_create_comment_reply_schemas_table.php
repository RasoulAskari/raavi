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
        Schema::create('comment_reply_schema', function (Blueprint $table) {
            $table->integer("comment_id")->unsigned()->nullable();
            $table->foreign("comment_id")->references("comments.id")->deferrable("deferred");
        });
  }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_reply_schemas');
    }
};
