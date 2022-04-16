<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = Staff::where('username', $request->username)->first();
        if (! $user || !Hash::check($request->password, $user->password)) {
          return response()->json(['Error'=>"Authentication Failed!"],400);
        }
        $token=$user->createToken($user->staff_id,$user->role_id)->plainTextToken;
        $request =new Request();
        $request->headers->set('Authorization', $token);
        return $token;
    }
}
