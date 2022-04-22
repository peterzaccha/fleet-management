<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    public function cities()
    {
        return $this->belongsToMany(City::class, "cross_cities")->withPivot(["order", "empty_seats"])->orderByPivot("order");
    }

    public function syncCities($cities)
    {
        $this->cities()->sync(
            collect($cities)
                ->mapWithKeys(fn ($c) => [$c["id"] => ["order" => $c["order"]]])
        );
        $this->generatePath();
    }

    public function generatePath()
    {
        $this->load('cities');
        $this->path = $this->cities->sortBy("order")
            ->map(fn ($city) => "-" . $city->id . "-" . chr($city->pivot->empty_seats + 64) . "-")
            ->implode(",");
        $this->save();
    }

    public function scopeAvailable(Builder $query, City $from, City $to)
    {
        return $query->whereHas("cities", function (Builder $builder) use ($from, $to) {
            $builder->where("csities.id", $from->id)->orWhere("cities.id", $to->id);
        }, "=", 2);
    }
}
