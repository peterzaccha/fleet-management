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
        // so every trip has a path that its repesented in these form
        // for example if trip going from Alex to Cairo to Giza the form would look like this
        // -<ALEX_ID>-<EMPTY_SEATS_IN_ALEX>--<CAIRO_ID>-<EMPTY_...>--<GIZA_ID>-<EMPTY_...>-
        // the empty seats represented as an ascci character from @ to L
        // @ meaning there is no empty seats
        // A meaning there is one empty seat
        // ...
        // L meaning there is 12 empty seats

        // finaly the purpose of all of this is to make the search query
        // for finding the available trips from start point to an end point
        // as simple as this :)
        return $query->where("path", "like", "%-" . $from->id . "-%-" . $to->id . "-%")
            ->where("path", "not like", "%-" . $from->id . "-%@%-" . $to->id . "-%-");
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
