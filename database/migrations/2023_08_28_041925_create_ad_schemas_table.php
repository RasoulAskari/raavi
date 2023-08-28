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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string("post_link");
            $table->integer("audience_count");
            $table->integer("views_count");
            $table->timestamp("expire_at");
            $table
                ->enum("status", ["active", "disabled", "expired"])
                ->index("ads_status_index", "hash")
                ->nullable();
            $table
                ->integer("post_id")
                ->nullable();
            // $table->foreign("post_id")->references("posts.id")->deferrable("deferred");
            // $table
            //     ->uuid("created_by")
            //     ->references("administrators.id")
            //     ->deferrable("deferred")
            //     ->unsigned()
            //     ->nullable()
            //     ->onDelete("SET NULL")
            //     ->index("ads_created_by_index", "hash");

            $table->string("expire_job_id");


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_schemas');
    }
};
