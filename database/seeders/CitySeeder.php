<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use JsonMachine\Items;
use Laravel\Prompts\Output\ConsoleOutput;
use Symfony\Component\Console\Helper\ProgressBar;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        City::truncate();
        $fileSize = filesize('database/data/cities.json');
        $cityData = Items::fromFile('database/data/cities.json');


        $output = new ConsoleOutput();
        $count = $fileSize;
        $progressBar = new ProgressBar($output, $count);
        $progressBar->start();

        foreach ($cityData as $name => $data) {

            $progressBar->advance();


            City::create([
                'id'=>$data->id,
                'name' => $data->name,
                "state_id" => $data->state_id ?? null,
                "state_code" => $data->state_code ?? null,
                "state_name" => $data->state_name ?? null,
                "country_id" => $data->country_id ?? null,
                "country_code" => $data->country_code ?? null,
                "country_name" => $data->country_name ?? null,
                "latitude" => $data->latitude ?? null,
                "longitude" => $data->longitude ?? null,
            ]);
        }

        $progressBar->finish();

        $output->write(' Finished', true);
    }
}
