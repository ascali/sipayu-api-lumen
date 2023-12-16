<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            return $this->jsonResponse(
                false,
                'Invalid credentials',
                [],
                401
            );
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

    public function list(Request $request)
    {
        $orderby = $request->input('order.0.column');
        $sort['col'] = $request->input('columns.' . $orderby . '.data');    
        $sort['dir'] = $request->input('order.0.dir');

        $query = DB::table('users')
            ->join('roles', 'users.id_role', '=', 'roles.id')
            ->select(
                'users.id',
                'users.name as users_name',
                'users.email as users_email',
                'users.mobile_no as users_mobile_no',
                'users.address as users_address',
                'users.latitude as users_latitude',
                'users.longitude as users_longitude',
                'users.created_at as users_created_at',
                'roles.name as roles_name',
            )
            ->whereNull('users.deleted_at')
            ->where('roles.id', '!=', 1)
            ->where(function ($query) use ($request) {
                $query->where('users.name', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('users.email', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('users.mobile_no', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('users.address', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('users.latitude', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('users.longitude', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('users.created_at', 'like', '%'. $request->input('search.value') .'%');
            });

        $output['recordsTotal'] = $query->count();

        $output['data'] = $query
                ->orderBy($sort['col'], $sort['dir'])
                ->skip($request->input('start'))
                ->take($request->input('length',10))
                ->get();

        $output['recordsFiltered'] = $output['recordsTotal'];

        $output['draw'] = intval($request->input('draw'));

        return $output;
    }
    
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'id_role' => 'required',
            'password' => 'required',
            'email' => 'required'
        ]);

        $is_data = new User();
        $is_data->name = $request->input('name');
        $is_data->id_role = $request->input('id_role');
        $is_data->email = $request->input('email');
        $is_data->password = app('hash')->make($request->get('password'));
        $is_data->mobile_no = $request->input('mobile_no');
        $is_data->address = $request->input('address');
        $is_data->latitude = $request->input('latitude');
        $is_data->longitude = $request->input('longitude');
        $is_data->save();

        return $this->jsonResponse(
            true,
            'Success',
            $is_data,
            201
        );
    }

    public function show($id)
    {
        $is_data = User::find($id);
        return $this->jsonResponse(
            true,
            'Success',
            $is_data,
            200
        );
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'id_role' => 'required',
            // 'password' => 'required',
            'email' => 'required'
        ]);

        $is_data = User::find($id);
        $is_data->name = $request->input('name');
        $is_data->id_role = $request->input('id_role');
        $is_data->email = $request->input('email');
        $is_data->password = app('hash')->make($request->get('password'));
        $is_data->mobile_no = $request->input('mobile_no');
        $is_data->address = $request->input('address');
        $is_data->latitude = $request->input('latitude');
        $is_data->longitude = $request->input('longitude');
        $is_data->save();

        return $this->jsonResponse(
            true,
            'Success',
            $is_data,
            200
        );
    }

    public function destroy($id)
    {
        $is_data = User::find($id);
        $is_data->delete();
        return $this->jsonResponse(
            true,
            'User Deleted Successfully',
            [],
            200
        );
    }

}
