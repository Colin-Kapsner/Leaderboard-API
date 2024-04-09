<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Time;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TimeResource;
use App\Http\Resources\TimesResource;


class TimeController extends Controller

{


    public function topTimes(Request $request)
    {
        // sort all times in descending order and return the top ones
        $query = $request->user()->times();

        if($request->input('page')){
            return new TimesResource($query->paginate(10));
        }
        return new TimesResource($query->orderBy('time', 'asc')->limit(10)->get());
    }

    public function allTopTimes(Request $request)
    {
        $times = Time::query()->orderBy('time', 'asc')->limit(10)->get();
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
        $request['user_id'] = Auth::user()->id;
        $time = new Time($request->all());
        $time->save();
        return response()->json([
            "message" => "Success!"
        ], 201);
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
    public function destroy(User $user)
    {
        //if($user->user_id == Auth::user()->id){
        //    $time->delete;
        //}
        //return response()->json([
        //    "message" => "Success! Deleted."
        //], 202);
    }
}
