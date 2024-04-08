<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Time;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TimeResource;
class TimeController extends Controller
{


    public function leaderboard()
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Auth::user()->users;
        return $users;
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
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
