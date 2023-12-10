<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login', 'refresh', 'logout']]);
    }

    public function index()
    {
        $is_data = Rating::all();
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
            'id_user' => 'required',
            'id_destination' => 'required',
            'rating' => 'required'
        ]);

        $is_data = new Rating();
        $is_data->id_user = $request->input('id_user');
        $is_data->id_destination = $request->input('id_destination');
        $is_data->rating = $request->input('rating');
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
        $is_data = Rating::find($id);
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
            'id_user' => 'required',
            'id_destination' => 'required',
            'rating' => 'required'
        ]);

        $is_data = Rating::find($id);
        $is_data->id_user = $request->input('id_user');
        $is_data->id_destination = $request->input('id_destination');
        $is_data->rating = $request->input('rating');
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
        $is_data = Rating::find($id);
        $is_data->delete();
        return $this->jsonResponse(
            true,
            'Rating Deleted Successfully',
            [],
            200
        );
    }
}