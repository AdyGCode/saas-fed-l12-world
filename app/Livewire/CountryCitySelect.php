<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Livewire\Component;

class CountryCitySelect extends Component
{
    public $countries;
    public $states = [];
    public $cities = [];

    public $country;
    public $state;
    public $city;

    public function mount()
    {
        $this->countries = Country::all();
    }

    public function updated($property)
    {
        if ($property === 'country') {
            $this->states = State::where('country_id', $this->country)
                ->get();
            $this->state = null;

            $this->city = null;

            $hasStates = State::where('country_id', $this->country)->exists();

            if ($hasStates) {
                // Filter by both country and selected state
                $this->cities = City::where('country_id', $this->country)
                    ->where('state_id', $this->state)
                    ->get();
            } else {
                // No states: fetch cities with null state_id
                $this->cities = City::where('country_id', $this->country)
                    ->whereNull('state_id')
                    ->get();
            }

        } elseif ($property === 'state') {
            $hasStates = State::where('country_id', $this->country)->exists();

            if ($hasStates) {
                // Filter by both country and selected state
                $this->cities = City::where('country_id', $this->country)
                    ->where('state_id', $this->state)
                    ->get();
            } else {
                // No states: fetch cities with null state_id
                $this->cities = City::where('country_id', $this->country)
                    ->whereNull('state_id')
                    ->get();
            }
        }
    }

    public function render()
    {
        return view('livewire.country-city-select');
    }
}
