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
                    ->unsignedBigInteger("shared_post");
                $table->foreign("shared_post")->references("id")->on('post_schemas')->deferrable("deferred");
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
