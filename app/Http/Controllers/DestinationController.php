<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;

class DestinationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login', 'refresh', 'logout']]);
    }

    public function index()
    {
        $is_data = Destination::all();
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
            'id_toi' => 'required',
            'name' => 'required',
            'image' => 'required',
            'contact' => 'required',
            'description' => 'required',
            'location' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $is_data = new Destination();
        $is_data->id_toi = $request->input('id_toi');
        $is_data->name = $request->input('name');
        $is_data->image = $request->input('image');
        $is_data->contact = $request->input('contact');
        $is_data->description = $request->input('description');
        $is_data->location = $request->input('location');
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
        $is_data = Destination::find($id);
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
            'id_toi' => 'required',
            'name' => 'required',
            'image' => 'required',
            'contact' => 'required',
            'description' => 'required',
            'location' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $is_data = Destination::find($id);
        $is_data->id_toi = $request->input('id_toi');
        $is_data->name = $request->input('name');
        $is_data->image = $request->input('image');
        $is_data->contact = $request->input('contact');
        $is_data->description = $request->input('description');
        $is_data->location = $request->input('location');
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
        $is_data = Destination::find($id);
        $is_data->delete();
        return $this->jsonResponse(
            true,
            'Destination Deleted Successfully',
            [],
            200
        );
    }
}