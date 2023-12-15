<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login', 'refresh', 'logout']]);
    }
    
    public function register(Request $request)
    { 
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {
            $data = new User;
            $data->id_role = $request->get('id_role') || 3;
            $data->name = $request->get('name');
            $data->email = $request->get('email');
            $data->address = $request->get('address');
            $data->mobile_no = $request->get('mobile_no');
            $data->latitude = $request->get('latitude');
            $data->longitude = $request->get('longitude');
            $data->password = app('hash')->make($request->get('password'));
            $data->save();

            return $this->jsonResponse(
                true,
                "Successfully created",
                [],
                201
            );
        } catch (\Exception $e) {
            return $this->jsonResponse(
                false,
                'Failed',
                [],
                409
            );
        }

    }

    /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return $this->jsonResponse(
            true,
            "Success",
            [
                'user'         => [
                    "id" => auth()->user()->id,
                    'id_role' => User::find(auth()->user()->id)->id_role,
                    "name" => auth()->user()->name,
                    "email" => auth()->user()->email,
                ],
                'expires_in'   => auth()->factory()->getTTL() * 60 * 24,
                'access_token' => $token,
                'token_type'   => 'bearer'
            ]
        );
    }

     /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return $this->jsonResponse(
            true,
            'Success',
            auth()->user(),
            200
        );
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return $this->jsonResponse(
            true,
            'Successfully logged out',
            [],
            200
        );
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->jsonResponse(
            true,
            'Successfully refreshed',
            auth()->refresh(),
            200
        );
    }
}
