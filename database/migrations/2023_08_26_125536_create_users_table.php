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
        Schema::create('users', function (Blueprint $table) {
            $table
                ->uuid("id")
                ->index("user_id_index", "hash");
            $table->string("full_name")->index("user_fullname_index", "btree");
            $table->string("username")->index("user_username_index", "btree");
            $table->string("phone_no")->index("user_phone_no_index", "btree");
            $table->text("bio")->nullable();
            $table->string("password")->nullable();
            $table->timestamp("birth_date")->nullable();
            $table->enum("gender", ["male", "female"]);
            $table
                ->enum("status", ["active", "suspended"])
                ->default("active")
                ->index("user_status_index", "hash");
            $table
                ->enum("profile_type", ["public", "private"])
                ->default("public")
                ->index("user_profile_type_index", "hash");

            $table->integer("profile_picture")->unsigned()->nullable();
            $table->integer("cover_photo")->unsigned()->nullable();
            $table->timestamp("phone_verified_at")->nullable();
            $table->timestamp("suspended_until")->nullable();
            $table->integer("suspended_id")->nullable();

            $table
                ->decimal("latitude", 14, 8)
                ->nullable()
                ->index("user_latitude_index", "hash");
            $table
                ->decimal("longitude", 14, 8)
                ->nullable()
                ->index("user_longitude_index", "hash");

            $table->integer("state_id")->nullable()->index("user_state_id_index", "hash");
            $table->foreign("state_id")->references("states->id")->deferrable("deferred");
            $table->boolean("verified")->default(false);
            $table
                ->uuid("verified_by")
                ->references("administrators->id")
                ->deferrable("deferred")
                ->index("user_verified_by_index", "hash");
            $table->timestamp("last_online");
            $table->timestamps();
        });

        Schema::create(
            'users',
            function (Blueprint $table) {
                $table
                    ->foreign("profile_picture")
                    ->references("attachments.id")
                    ->deferrable("deferred");
                $table
                    ->foreign("cover_photo")
                    ->references("attachments->id")
                    ->deferrable("deferred");
            }
        );
        Schema::create(
            'users',
            function (Blueprint $table) {
                $table->id();
                $table
                    ->uuid("user_id")
                    ->references("users.id")
                    ->deferrable("deferred")
                    ->index("user_search_history_user_id_index", "hash");
                $table->string("search_text")->index("user_search_text_index", "btree");
            }
        );
        Schema::create(
            'users',
            function (Blueprint $table) {
                $table->id();
                $table
                    ->uuid("user_id")
                    ->references("users.id")
                    ->deferrable("deferred")
                    ->index("user_fcm_token_user_id_index", "hash");
                $table->text("fcm_token")->nullable();
            }
        );
        Schema::create(
            'users',
            function (Blueprint $table) {
                $table->id();
                $table
                    ->uuid("user_id")
                    ->references("users.id")
                    ->deferrable("deferred")
                    ->index("user_block_user_id_index", "hash");
                $table
                    ->uuid("blocked_user_id")
                    ->references("users.id")
                    ->deferrable("deferred")
                    ->index("user_block_blocked_id_index", "hash");
            }
        );
        Schema::create(
            'users',
            function (Blueprint $table) {
                $table->id();
                $table
                    ->uuid("user_id")
                    ->references("users.id")
                    ->deferrable("deferred")
                    ->index("user_privacy_user_id_index", "hash");
                $table
                    ->enum("privacy_type", ["follow_list", "profile_privacy"])
                    ->index("user_privacy_type_index", "hash");
                $table->string("privacy_value")->index("user_privacy_value_index", "hash");
            }
        );
        Schema::create(
            'users',
            function (Blueprint $table) {
                $table->id();
                $table
                    ->uuid("followed_id")
                    ->references("users.id")
                    ->deferrable("deferred")
                    ->index("following_followed_index", "hash");
                $table
                    ->uuid("follower_id")
                    ->references("users.id")
                    ->deferrable("deferred")
                    ->index("following_follower_index", "hash");
            }
        );
        Schema::create(
            'users',
            function (Blueprint $table) {
                $table->id();
                $table
                    ->uuid("user_id")
                    ->references("users.id")
                    ->deferrable("deferred")
                    ->index("suggest_user_id_index", "hash");
                $table
                    ->uuid("created_by")
                    ->references("administrators->id")
                    ->deferrable("deferred")
                    ->index("suggest_created_by_index", "hash");
            }
        );
        Schema::create(
            'users',
            function (Blueprint $table) {
                $table->id();
                $table
                    ->uuid("receiver_id")
                    ->references("users.id")
                    ->deferrable("deferred")
                    ->index("follow_request_receiver_index", "hash");
                $table
                    ->uuid("sender_id")
                    ->references("users.id")
                    ->deferrable("deferred")
                    ->index("follow_request_sender_index", "hash");
            }
        );
        Schema::create(
            'users',
            function (Blueprint $table) {
                $table->id();
                $table
                    ->uuid("receiver_id")
                    ->references("users.id")
                    ->deferrable("deferred")
                    ->index("message_request_receiver_id_index", "hash");
                $table
                    ->uuid("sender_id")
                    ->references("users.id")
                    ->deferrable("deferred")
                    ->index("message_request_sender_id_index", "hash");
                $table->integer("chat_id")->references("chats->id")->deferrable("deferred");

            }
        );
        Schema::create(
            'users',
            function (Blueprint $table) {
                $table->id();
                $table->uuid("user_id")->nullable()->index("user_verify_user_id_index", "hash");
                $table->foreign("user_id")->references("users.id")->deferrable("deferred");
                $table->integer("attachment_id")->unsigned()->nullable();
                $table
                    ->foreign("attachment_id")
                    ->references("attachments->id")
                    ->deferrable("deferred");
            }
        );
        Schema::create(
            'users',
            function (Blueprint $table) {
                $table->id();
                $table->string("phone")->index("login_code_phone_index", "hash");
                $table->string("code")->index("login_code_code_index", "hash");
            }
        );
    }

    /**
     * Reverse the migrations->
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
