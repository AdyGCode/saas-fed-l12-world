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

        Schema::create('country_timezone', function (Blueprint $table) {
            $table->id();
            $table->foreignId('timezone_id');
            $table->foreignId('country_id');
            $table->timestamps();

        });

        Schema::create('countries', function (Blueprint $table) {
            $table->id();

            $table->string("name", 255);
            $table->string("iso3", 3);
            $table->string("iso2", 2);
            $table->string("numeric_code", 6);
            $table->string("phone_code", 6);
            $table->string("capital", 128);
            $table->string("currency", 128);
            $table->string("currency_name", 128);
            $table->string("currency_symbol", 32);
            $table->string("tld", 6);
            $table->string("native", 128)->nullable();
            $table->foreignId("region_id")->nullable();
            $table->foreignId("subregion_id")->nullable();
            $table->string("nationality");
            $table->float("latitude");
            $table->float("longitude");
            $table->string("emoji", 6);
            $table->string("emojiU", 6);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country_timezones');
        Schema::dropIfExists('countries');
    }
};
