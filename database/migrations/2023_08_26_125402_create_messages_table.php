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
        Schema::create('message_schemas', function (Blueprint $table) {
            $table->id();
            $table->text("message")->index("message_message_index", "btree");
            $table->timestamps(true, true);
            $table
                ->uuid("sender_id")
                ->references("users->id")
                ->deferrable("deferred")
                ->index("message_sender_id_index", "hash");
            $table
                ->integer("chat_id")
                ->unsigned()
                ->notNullable()
                ->index("message_chat_id_index", "hash");
            $table->foreign("chat_id")->references("chats->id")->deferrable("deferred");
            $table
                ->enum("attachment_type", ["none", "voice", "image_video"])
                ->default("none");
            $table
                ->integer("reply_to")
                ->unsigned()
                ->nullable()
                ->index("message_reply_index", "hash");
            $table->json("recipients")->nullable();

            $table->boolean("seen")->default(false);
            $table->timestamp("deleted_at");

            $table->timestamps();
        });


        Schema::create(
            'message_schemas',
            function (Blueprint $table) {
                $table->id();
                $table->integer("message_id")->unsigned()->notNullable();
                $table->foreign("message_id")->references("messages->id")->deferrable("deferred");
                $table->integer("attachment_id")->unsigned()->notNullable();
                $table
                    ->foreign("attachment_id")
                    ->references("message_attachments->id")
                    ->deferrable("deferred");
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
