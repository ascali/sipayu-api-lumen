<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['register', 'login', 'refresh', 'logout']]);
    }
    
    public function register(Request $request)
    { 
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {
            $isAccess = $request->get('is_access') == "web" ? $request->get('id_role') : 3;
            $data = new User;
            $data->id_role = $isAccess;
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
                'users.image as users_image',
                'roles.name as roles_name',
            )
            ->whereNull('users.deleted_at')
            // ->where('roles.id', '!=', 1)
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

        $upload_to_storage = $this->uploadToStorage($request->input('image'));

        $is_data = new User();
        $is_data->name = $request->input('name');
        $is_data->id_role = $request->input('id_role');
        $is_data->email = $request->input('email');
        $is_data->password = app('hash')->make($request->get('password'));
        $is_data->mobile_no = $request->input('mobile_no');
        $is_data->address = $request->input('address');
        $is_data->latitude = $request->input('latitude');
        $is_data->longitude = $request->input('longitude');
        $is_data->image = $upload_to_storage;
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

        $upload_to_storage = $this->uploadToStorage($request->input('image'));

        $is_data = User::find($id);
        $is_data->name = $request->input('name');
        $is_data->id_role = $request->input('id_role');
        $is_data->email = $request->input('email');
        if ($request->get('password') != "") {
            $is_data->password = app('hash')->make($request->get('password'));
        }
        $is_data->mobile_no = $request->input('mobile_no');
        $is_data->address = $request->input('address');
        $is_data->latitude = $request->input('latitude');
        $is_data->longitude = $request->input('longitude');
        $is_data->image = $upload_to_storage; 
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

    public function forgot(Request $request) {

        $this->validate($request,[
            'email' => 'required'
        ]);

        $query = DB::table('users')
            ->select("users.id", "users.name", "users.email")
            ->whereRaw('LOWER(users.email) = ?', (strtolower($request->email)))
            ->first();
        
        if ($query) {
            $message = 'Success';
            Mail::send('mail.mail', array("data" => $query, "date" => date("Y-m-d H:i:s")), function($message) use ($query) {
                $message->to($query->email, $query->name)->subject('Lupa Kata Sandi - SIPAYU');
                $message->from('noreply@ipayu.indramayukab.go.id','No Reply - SIPAYU');
            });
        } else {
            $query = [];
            $message = 'Email not found!';
        }

        return $this->jsonResponse(
            true,
            $message,
            $query,
            200
        );
    }

    public function resetPassword(Request $request, $id)
    {
        $this->validate($request,[
            'id' => 'required',
            'password' => 'required'
        ]);

        $is_data = User::find($id);
        if ($request->get('password') != "") {
            $is_data->password = app('hash')->make($request->get('password'));
        }
        $is_data->save();

        return $this->jsonResponse(
            true,
            'Success',
            $is_data,
            200
        );
    }

}
