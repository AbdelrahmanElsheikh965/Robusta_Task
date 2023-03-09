<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Seat;
use App\Models\Station;
use App\Models\Trip;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;

class SeatController extends Controller
{
    // can't access this function if not authenticated
    public function listAvailableSeats(Request $request)
    {
        date_default_timezone_set('Africa/Cairo');   // set your default timezone
        $stationStart = Station::find($request->start_station_id);
        $stationStart = $stationStart->station_time;

        $stationEnd = Station::find($request->end_station_id);
        $stationEnd = $stationEnd->station_time;

        $stationStart   = (int) substr($stationStart,0, 2);
        $timeNow        = (int) Carbon::now()->format('H');
        if ($timeNow > $stationStart && $timeNow < $stationEnd){
            // get seats attached to buses attached to this trip.
            $seatsCount = DB::table('trips')->where('start_station_id', '=', $request->start_station_id)
                                ->where('end_station_id', '=', $request->end_station_id)
                                ->join('seats', 'trips.id', '=', 'seats.bus_id')
                                ->pluck('user_id')->toArray();

            if ( in_array(null, $seatsCount)){
                // True means there's an empty place user can book.
                $seat = Seat::where('user_id', null)->get();
                return response()->json(['Available seats are ' => $seat->map->only('name')]);
            }else{
                // Not empty means all seats are busy.
                return response()->json('Sorry no seats are available');
            }

        }
        return 'out of range';
    }

    public function bookASeat(Request $request)
    {
        date_default_timezone_set('Africa/Cairo');   // set your default timezone
        $stationStart = Station::find($request->start_station_id);
        $stationStart = $stationStart->station_time;

        $stationEnd = Station::find($request->end_station_id);
        $stationEnd = $stationEnd->station_time;

        $stationStart   = (int) substr($stationStart,0, 2);
        $timeNow        = (int) Carbon::now()->format('H');
        if ($timeNow > $stationStart && $timeNow < $stationEnd) {
            // get seats attached to buses attached to this trip.
            $seatsCount = DB::table('trips')->where('start_station_id', '=', $request->start_station_id)
                ->where('end_station_id', '=', $request->end_station_id)
                ->join('seats', 'trips.id', '=', 'seats.bus_id')
                ->pluck('user_id')->toArray();
            // get user id
            $userId = auth()->user()->id;
            $name = $request->seatName;
            // insert into seats table where name is in returned array (seatsCount)
            // insert where name = returned name from the list function.
            $book = DB::table('seats')->where('user_id', '=',null)
                                        ->where('name', $name)
                                        ->update(array('user_id' => $userId));
            if ($book)
                return 'Updated';
        }
    }
}
