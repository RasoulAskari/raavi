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
            'state_schemas',
            function (Blueprint $table) {
                $table->id();

                $table->string("name");
                $table->string("state_code");
                $table->string("latitude");
                $table->string("longitude");
                $table->string("type")->nullable();
                $table
                    ->integer("country_id")
                    ->unsigned()
                    ->index("state_country_id_index", "hash");
                $table->foreign("country_id")->references("countrie_schemas.id")->deferrable("deferred");
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('state_schemas');
    }
};
