<?php

namespace Database\Seeders;

use App\Models\State;
use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class StateCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statesPath = public_path('json/states.json');
        $citiesPath = public_path('json/cities.json');

        // Load and decode JSON data
        $states = json_decode(File::get($statesPath), true);
        $cities = json_decode(File::get($citiesPath), true);

        // Prompt user to select countries
        $selectedCountries = $this->command->choice(
            'Which countries\' states do you want to seed?',
            collect($states)->pluck('country_name', 'country_name')->sort()->unique()->toArray(),
            multiple: true
        );

        // Filter states for selected countries
        $filteredStates = collect($states)->whereIn('country_name', $selectedCountries)->all();

        // Create a progress bar
        $progressBar = $this->command->getOutput()->createProgressBar(count($filteredStates));
        $progressBar->start();

        foreach ($filteredStates as $state) {
            // Update or create state
            $stateModel = State::updateOrCreate([
                'name' => $state['state_name'],
                'code' => $state['state_code'],
            ]);

            // Filter cities for the current state
            $stateCities = collect($cities)
                ->where('state_code', $stateModel->code)
                ->map(fn($city) => ['name' => $city['city_name']])
                ->toArray();

            // Batch insert or update cities for the state
            $stateModel->cities()->upsert($stateCities, ['name'], ['name']);

            // Advance progress bar
            $progressBar->advance();
        }

        // Finish the progress bar
        $progressBar->finish();

        // Add a new line after the progress bar
        $this->command->info(PHP_EOL . 'Seeding completed!');
    }
}
