<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Requests\GetAvailableSeatsRequest;
use App\Models\Booking;
use App\Models\City;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TripController extends Controller
{
    public function getAvailableSeats(GetAvailableSeatsRequest $request)
    {
        $from = City::findOrFail($request->from);
        $to = City::findOrFail($request->to);

        $trips = Trip::where("path", "like", "%-" . $from->id . "-%-" . $to->id . "-%")
            ->where("path", "not like", "%-" . $from->id . "-%@%-" . $to->id . "-%-");

        return $trips->with("cities")->get();
    }

    public function book(BookRequest $request)
    {
        $from = City::findOrFail($request->from);
        $to = City::findOrFail($request->to);
        $user = $request->user();

        $trip = Trip::where("path", "like", "%-" . $from->id . "-%-" . $to->id . "-%")
            ->where("path", "not like", "%-" . $from->id . "-%@%-" . $to->id . "-%-")
            ->where("id", $request->trip_id)
            ->firstOrFail();

        $start = $trip->cities->where('id', $from->id)->first()->pivot->order;
        $end = $trip->cities->where('id', $to->id)->first()->pivot->order;

        $citiesRange = $trip->cities
            ->filter(fn ($city) => $city->pivot->order >= $start && $city->pivot->order <= $end);


        $availableSeats = $citiesRange->pluck("pivot.empty_seats")->min();

        $requestedSeats = $request->number_of_seats;


        abort_if($availableSeats < $requestedSeats, 406, "This Trip dose not have $requestedSeats seats");

        DB::beginTransaction(function () use ($trip, $from, $to, $requestedSeats, $citiesRange, $user) {
            $booking = Booking::create([
                'user_id' => $user->id,
                'trip_id' => $trip->id,
                'start_id' => $from->id,
                'end_id' => $to->id,
                'seats' => $requestedSeats
            ]);
            $trip->cities()->syncWithoutDetaching(
                $citiesRange
                    ->mapWithKeys(fn ($city) => [$city->id => ['empty_seats' => $city->pivot->empty_seats - $requestedSeats]])
            );

            $trip->generatePath();
        });

        return ["status" => "success"];
    }
}
