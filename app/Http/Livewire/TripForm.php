<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Trip;
use Livewire\Component;
use tidy;

class TripForm extends Component
{
    public $name;
    public $trip;
    public $selectedCity;
    public $cities = [];
    public $allCities = [];

    public function mount()
    {
        $this->rules =  [
            'name' => 'required|min:4|unique:trips,name' . ($this->trip ? "," . $this->trip->id : ""),
        ];
        $this->allCities = City::pluck('name', 'id');
        if ($this->trip) {
            $this->name = $this->trip->name;
            $this->trip->cities->map(function ($c) {
                $this->selectedCity = $c->id;
                $this->addCity();
            });
        } else {
            $this->trip = Trip::make();
        }
    }

    public function addCity()
    {
        if ($city = City::find($this->selectedCity)) {
            $array = $city->toArray();
            $array['order'] = count($this->cities) + 1;
            array_push($this->cities, $array);
            unset($this->allCities[$city->id]);
            $this->selectedCity = null;
        }
    }

    public function removeCity($id)
    {
        $this->cities = collect($this->cities)->filter(fn ($c) => $c['id'] != $id)->toArray();
        $city = City::find($id);
        $this->allCities[$city->id] = $city->name;
    }

    public function updateCitiesOrder($newOrder)
    {
        $citiesCollection = collect($this->cities);
        $this->cities = collect($newOrder)
            ->map(function ($o) use ($citiesCollection) {
                $city = $citiesCollection->firstWhere('id', $o['value']);
                $city['order'] = $o['order'];
                return $city;
            })->toArray();
    }

    public function submit()
    {
        $this->validate();

        if (count($this->cities) < 2) {
            session()->flash('error', 'You should enter at least two cities');
            return;
        }

        $this->trip->name = $this->name;
        $this->trip->save();

        $this->trip->cities()->sync(
            collect($this->cities)
                ->mapWithKeys(fn ($c) => [$c["id"] => ["order" => $c["order"]]])
        );

        return redirect()->route("trips.index");
    }
}
