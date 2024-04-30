<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Time;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\TimeResource;
use App\Http\Resources\TimesResource;
use App\Http\Resources\HighscoreResource;
use App\Http\Resources\HighscoresResource;


class TimeController extends Controller

{


    public function topTimes(Request $request)
    {
        $query = $request->user()->times();

        if($request->input('page')){
            return new TimesResource($query->paginate(10));
        }
        return new TimesResource($query->orderBy('time', 'asc')->limit(10)->get());
    }

    public function allTopTimes(Request $request)
    {
        $times = DB::table('times')
                        ->join('users', 'users.id', '=', 'times.user_id')
                        ->selectRaw("users.username as username, min(time) as time")
                        ->where('time', '>', '9.5')
                        ->groupBy('users.username')
                        ->orderBy('time', 'asc')
                        ->get();
                        //dd($times);
        return new HighscoresResource($times);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $times = Auth::user()->times;
        return $times;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $time = $request->user()->times()->create($request->input("data.attributes"));
        return (new TimeResource($time))->response()->header("Location", route("times.show", ['time' => $time->id]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Time $time)
    {
        return new TimeResource($time);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Time $time)
    {
        $time->delete();
        return response()->json([
            "message" => "Success! Deleted."
        ], 202);
    }
}
