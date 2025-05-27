<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Laravel\Prompts\Output\ConsoleOutput;
use Symfony\Component\Console\Helper\ProgressBar;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Region::truncate();

        $json = File::get('database/data/regions.json');

        $regions = json_decode($json);

        $output = new ConsoleOutput();
        $count = count($regions);
        $progressBar = new ProgressBar($output, $count);
        $progressBar->start();

        foreach ($regions as $key => $value) {
            // TODO: this will need to be extended to provide for translation import.

            $progressBar->advance();


            Region::create([
                'id' => $value->id,
                'name' => $value->name,
            ]);
        }

        $progressBar->finish();

        $output->write(' Finished', true);
    }
}
