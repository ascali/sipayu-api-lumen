<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login', 'refresh', 'logout']]);
    }

    public function index()
    {
        $is_data = History::all();
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
            'status' => 'required',
            'description' => 'required'
        ]);

        $is_data = new History();
        $is_data->name = $request->input('name');
        $is_data->status = $request->input('status');
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
        $is_data = History::find($id);
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

        $is_data = History::find($id);
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
        $is_data = History::find($id);
        $is_data->delete();
        return $this->jsonResponse(
            true,
            'History Deleted Successfully',
            [],
            200
        );
    }
}