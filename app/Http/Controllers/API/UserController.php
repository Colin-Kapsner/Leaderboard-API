<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UsersResource;
use Attribute;

class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create($request->input("data.attributes"));
        $tokenText = $user->createToken($request->input("data.attributes.device_name"))->plainTextToken;
        return ['token' => $tokenText];
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        $user->delete();
        return response()->json([
            "message" => "Success! Deleted."
        ], 202);
    }
}
