<?php

namespace Database\Seeders;

use App\Models\SubRegion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Laravel\Prompts\Output\ConsoleOutput;
use Symfony\Component\Console\Helper\ProgressBar;

class SubRegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubRegion::truncate();

        $json = File::get('database/data/subregions.json');

        $subregions = json_decode($json);

        $output = new ConsoleOutput();
        $count = count($subregions);
        $progressBar = new ProgressBar($output, $count);
        $progressBar->start();

        foreach ($subregions as $key => $value) {
            // TODO: this will need to be extended to provide for translation import.

            $progressBar->advance();

            SubRegion::create([
                'id' => $value->id,
                'name' => $value->name,
                'region_id' => $value->region_id,
            ]);
        }

        $progressBar->finish();

        $output->write(' Finished', true);
    }
}
