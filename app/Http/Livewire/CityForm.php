<?php

namespace App\Http\Livewire;

use App\Models\City;
use Livewire\Component;

class CityForm extends Component
{
    public $name;
    public $city;

    public function mount()
    {
        $this->rules =  [
            'name' => 'required|min:4|unique:cities,name' . ($this->city ? "," . $this->city->id : ""),
        ];

        if ($this->city) {
            $this->name = $this->city->name;
        } else {
            $this->city = City::make();
        }
    }


    public function submit()
    {
        $this->validate();

        $this->city->name = $this->name;
        $this->city->save();

        return redirect()->route("cities.index");
    }
}
