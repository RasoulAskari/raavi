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
            'message_reply_schemas',
            function (Blueprint $table) {
                $table->id();
                $table->integer("message_id")->unsigned()->notNullable();
                $table->foreign("message_id")->references("messages->id")->deferrable("deferred");
                $table->integer("attachment_id")->unsigned()->notNullable();
                $table
                    ->foreign("attachment_id")
                    ->references("message_attachment_schemas->id")
                    ->deferrable("deferred");
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_reply_schemas');
    }
};
