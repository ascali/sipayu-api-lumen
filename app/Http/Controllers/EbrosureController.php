<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ebrosure;

class EbrosureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login', 'refresh', 'logout']]);
    }

    public function index()
    {
        $is_data = Ebrosure::all();
        return $this->jsonResponse(
            true,
            'Success',
            $is_data,
            200
        );
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'efective' => 'required',
            'expired' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $is_data = new Ebrosure();
        $is_data->name = $request->input('name');
        $is_data->description = $request->input('description');
        $is_data->image = $request->input('image');
        $is_data->efective = $request->input('efective');
        $is_data->expired = $request->input('expired');
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
        $is_data = Ebrosure::find($id);
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
            'status' => 'required',
            'description' => 'required'
        ]);

        $is_data = Ebrosure::find($id);
        $is_data->name = $request->input('name');
        $is_data->status = $request->input('status');
        $is_data->description = $request->input('description');
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
        $is_data = Ebrosure::find($id);
        $is_data->delete();
        return $this->jsonResponse(
            true,
            'Ebrosure Deleted Successfully',
            [],
            200
        );
    }
}