<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Laravel\Prompts\Output\ConsoleOutput;
use Symfony\Component\Console\Helper\ProgressBar;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        State::truncate();

        $json = File::get('database/data/states.json');

        $states = json_decode($json);

        $output = new ConsoleOutput();
        $count = count($states);
        $progressBar = new ProgressBar($output, $count);
        $progressBar->start();

        foreach ($states as $key => $value) {
            // TODO: this will need to be extended to provide for translation import.

            $progressBar->advance();

            $state = State::create([
                'id' => $value->id,

                'name' => $value->name,
                "country_id" => $value->country_id,
                "country_code" => $value->country_code,
                "country_name" => $value->country_name,
                "state_code" => $value->state_code,
                "type" => $value->type,
                "latitude" => $value->latitude,
                "longitude" => $value->longitude,
            ]);

        }

        $progressBar->finish();

        $output->write(' Finished', true);
    }
}
