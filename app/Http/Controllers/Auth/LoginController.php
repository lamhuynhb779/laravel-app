<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(Request $request) {
        $this->validateLogin($request);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::guard()->user();
            $user->generateToken();

            return response()->json([
                'data' => $user->toArray(),
            ]);
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request) {
        $user = Auth::guard('api')->user();
        
        // We can access the current user using the $request->user() method or through the Auth facade
        // Auth::guard('api')->user(); // instance of the logged user
        // Auth::guard('api')->check(); // if a user is authenticated
        // Auth::guard('api')->id(); // the id of the authenticated user

        if ($user) {
            $user->api_token = null;
            $user->save();
        }

        return response()->json([
            'data' => 'User ' . Auth::guard('api')->id() . ' logged out.'
        ], 200);
    }


    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email', 
            'password' => 'required',
            // new rules here
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [ 'error' => trans('auth.failed') ];

        return response()->json($errors, 422);
    }

    // Login

    //$ curl -X POST localhost:8000/api/login \
  //-H "Accept: application/json" \
  //-H "Content-type: application/json" \
  //-d "{\"email\": \"admin@test.com\", \"password\": \"toptal\" }"

  /**
   * To send the token in a request, you can do it by sending an attribute api_token
   * in the payload or as a bearer token in the request headers in the form of 
   * Authorization: Bearer Jll7q0BSijLOrzaOSm5Dr5hW9cJRZAJKOzvDlxjKCXepwAeZ7JR6YP5zQqnw.
   */

   // Logout

   //$ curl --location --request POST 'localhost:8000/api/logout' \
//--header 'Content-Type: application/json' \
//--header 'Accept: application/json' \
//--header 'Authorization: Bearer uEu97AFAUaymLZKmmPLL2z6LwJY6XTuaAfdnwJmxv2kbkPn318ZhECXCCmBW'
}
