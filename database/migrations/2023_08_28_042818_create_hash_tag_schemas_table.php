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

            'hash_tag_schemas',
            function (Blueprint $table) {
                $table->id();

                $table->string("title")->index("hashtag_title_index", "hash");
                $table->timestamps(true, true);
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hash_tag_schemas');
    }
};
