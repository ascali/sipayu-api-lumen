<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login', 'refresh', 'logout']]);
    }

    public function index()
    {
        $is_data = Review::all();
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
            'id_rating' => 'required',
            'review' => 'required',
            'image' => 'required',
        ]);

        $is_data = new Review();
        $is_data->id_user = $request-input('id_user');
        $is_data->id_destination = $request-input('id_destination');
        $is_data->id_rating = $request-input('id_rating');
        $is_data->review = $request-input('review');
        $is_data->image = $request-input('image');
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
        $is_data = Review::find($id);
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
            'id_rating' => 'required',
            'review' => 'required',
            'image' => 'required',
        ]);

        $is_data = Review::find($id);
        $is_data->id_user = $request-input('id_user');
        $is_data->id_destination = $request-input('id_destination');
        $is_data->id_rating = $request-input('id_rating');
        $is_data->review = $request-input('review');
        $is_data->image = $request-input('image');
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
        $is_data = Review::find($id);
        $is_data->delete();
        return $this->jsonResponse(
            true,
            'Review Deleted Successfully',
            [],
            200
        );
    }
}