<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthnicationController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validated=$request->validated();
        $user=User::create($validated);
        $token = $user->createToken('RegisterToken')->plainTextToken;
        return response()->json(["user"=>$user,"token"=>$token],200,["messgae"=>"Register done"]);
    }
    public function login(LoginRequest $request)
    {
        $validated=$request->validated();
        $user=User::where("email",$request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password))
        {
            return response()->json(['message' => 'Invalid credentials.'], 422);
        }
        $token = $user->createToken('LoginToken')->plainTextToken;
        return response()->json(["user"=>$user,"token"=>$token],200,["messgae"=>"Login done"]);
    }
    public function logout()
    {
        $user=Auth::user();
        $user->tokens()->delete();
        return response()->noContent();
    }
    public function changePassword(Request $request)
    {
        $user=Auth::user();
        if(!Hash::check($request->old_password, $user->password))
        {
            return "Wrong password";
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return "changed";
    }
}
