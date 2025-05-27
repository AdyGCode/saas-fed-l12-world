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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();

        $table->string("name"); // "Ashkāsham",
        $table->foreignId("state_id")->nullable(); // 3901,
        $table->string("state_code",6)->nullable(); // "BDS",
        $table->string("state_name",192)->nullable(); // "Badakhshan",
        $table->foreignId("country_id")->nullable(); // 1,
        $table->string("country_code")->nullable(); // "AF",
        $table->string("country_name")->nullable(); // "Afghanistan",
        $table->float("latitude")->nullable(); // "36.68333000",
        $table->float("longitude")->nullable(); // "71.53333000",

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
