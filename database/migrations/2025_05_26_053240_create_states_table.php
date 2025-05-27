<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();

            $table->string("name",192); //: "Badakhshan",
            $table->foreignId("country_id"); //: 1,
            $table->string("country_code", 3); //: "AF",
            $table->string("country_name", 192); //: "Afghanistan",
            $table->string("state_code", 6); //: "BDS",
            $table->string("type")->nullable(); //: null,
            $table->float("latitude")->nullable(); //: "36.73477250",
            $table->float("longitude")->nullable(); //: "70.81199530"

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
