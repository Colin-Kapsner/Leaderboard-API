<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Time;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TimeResource;
use App\Http\Resources\TimesResource;
use Illuminate\Support\Facades\DB;

class TimeController extends Controller

{


    public function topTimes(Request $request)
    {
        $query = $request->user()->times()->where('time', '>', 9.5);

        if($request->input('page')){
            return new TimesResource($query->paginate(9.5));
        }
        return new TimesResource($query->orderBy('time', 'asc')->limit(10)->get());
    }

    public function allTopTimes(Request $request)
    {

        $times = Time::query()
                ->where('time', '>', 9)
                ->orderBy('time', 'asc')
                ->distinct('user_id')
                ->limit(10)
                ->get();
        
        return new TimesResource($times);
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
