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
            'cities_schema',
            function (Blueprint $table) {
                $table->id();

                $table->string("name");
                $table->string("latitude");
                $table->string("longitude");
                $table->integer("state_id")->unsigned()->index("city_state_id_index", "hash");
                $table->foreign("state_id")->references("states.id")->deferrable("deferred");
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities_schemas');
    }
};
