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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->boolean("is_accepted")->defaultTo(true);
            $table->timestamps(true, true);
            $table->timestamp("last_messaged_at");
            $table->json("recipients")->nullable();

            $table->timestamps();
        });

        Schema::create('user_chat_schema', function (Blueprint $table) {
            $table->id();
            $table
                ->integer("chat_id")
                ->unsigned()
                ->notNullable()
                ->index("user_chat_chat_id_index", "hash");
            $table->foreign("chat_id")->references("chats.id")->deferrable("deferred");
            $table
                ->uuid("user_id")
                ->references("users.id")
                ->deferrable("deferred")
                ->index("user_chat_user_id_index", "hash");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
