<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Timezone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Laravel\Prompts\Output\ConsoleOutput;
use Symfony\Component\Console\Helper\ProgressBar;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::truncate();
        Timezone::truncate();

        $json = File::get('database/data/countries.json');

        $countries = json_decode($json);

        $output = new ConsoleOutput();
        $count = count($countries);
        $progressBar = new ProgressBar($output, $count);
        $progressBar->start();

        foreach ($countries as $key => $value) {
            // TODO: this will need to be extended to provide for translation import.

            $progressBar->advance();


            $country = Country::create([
                'id' => $value->id,
                'name' => $value->name,
                "iso3" => $value->iso3,
                "iso2" => $value->iso2,
                "numeric_code" => $value->numeric_code,
                "phone_code" => $value->phone_code,
                "capital" => $value->capital,
                "currency" => $value->currency,
                "currency_name" => $value->currency_name,
                "currency_symbol" => $value->currency_symbol,
                "tld" => $value->tld,
                "native" => $value->native,
                "region_id" => $value->region_id,
                "subregion_id" => $value->subregion_id,
                "nationality" => $value->nationality,
                "latitude" => $value->latitude,
                "longitude" => $value->longitude,
                "emoji" => $value->emoji,
                "emojiU" => $value->emojiU,
            ]);

            $tzs = [];
            $value->timezones = $value->timezones?? [];
            foreach ($value->timezones as $timezone) {
                $tzs[] = Timezone::updateOrCreate([
                    "zoneName" => $timezone->zoneName,
                    "gmtOffset" => $timezone->gmtOffset,
                    "gmtOffsetName" => $timezone->gmtOffsetName,
                    "abbreviation" => $timezone->abbreviation,
                    "tzName" => $timezone->tzName,
                ]);

                $country->timezones()->sync($tzs);
            }

        }

        $progressBar->finish();

        $output->write(' Finished', true);
    }

}
