<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
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
        $user = new User($request->all());
        $user->save();
        return response()->json([
            "message" => "Success!"
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if($user->user_id == Auth::user()->id){
            return new UserResource($user);
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if($user->user_id == Auth::user()->id){
            $user->update($request->all());
        }
        return response()->json([
            "message" => "Success! Updated."
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if($user->user_id == Auth::user()->id){
            $user->delete;
        }
        return response()->json([
            "message" => "Success! Deleted."
        ], 202);
    }
}
