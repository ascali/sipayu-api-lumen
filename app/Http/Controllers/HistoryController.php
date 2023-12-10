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
            'id_user' => 'required',
            'id_destination' => 'required',
            'visited_date' => 'required'
        ]);

        $is_data = new History();
        $is_data->id_user = $request->input('id_user');
        $is_data->id_destination = $request->input('id_destination');
        $is_data->visited_date = $request->input('visited_date');
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
            'id_user' => 'required',
            'id_destination' => 'required',
            'visited_date' => 'required'
        ]);

        $is_data = History::find($id);
        $is_data->id_user = $request->input('id_user');
        $is_data->id_destination = $request->input('id_destination');
        $is_data->visited_date = $request->input('visited_date');
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