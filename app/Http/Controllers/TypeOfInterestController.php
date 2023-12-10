<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type_of_interest;

class TypeOfInterestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login', 'refresh', 'logout']]);
    }

    public function index()
    {
        $is_data = Type_of_interest::all();
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
            'image' => 'required',
            'description' => 'required'
        ]);

        $is_data = new Type_of_interest();
        $is_data->name = $request->input('name');
        $is_data->image = $request->input('image');
        $is_data->description = $request->input('description');
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
        $is_data = Type_of_interest::find($id);
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
            'image' => 'required',
            'description' => 'required'
        ]);

        $is_data = Type_of_interest::find($id);
        $is_data->name = $request->input('name');
        $is_data->image = $request->input('image');
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
        $is_data = Type_of_interest::find($id);
        $is_data->delete();
        return $this->jsonResponse(
            true,
            'Type_of_interest Deleted Successfully',
            [],
            200
        );
    }
}