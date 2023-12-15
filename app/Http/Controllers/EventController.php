<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login', 'refresh', 'logout']]);
    }

    public function index(Request $request)
    {
        $is_data = [];
        $page = $request->input('page') != '' ? $request->input('page') : 1;
        $limit = $request->input('limit') != '' ? $request->input('limit') : 5;
        $year = $request->input('year');
        $month = $request->input('month');
        if ($request->input('month')!='' && $request->input('year')!='') {
            $is_data = Event::whereYear('date_event', '=', $year)->whereMonth('date_event', '=', $month)->get()->toArray();
        }
        if ($request->input('page')!='' && $request->input('limit')!='') {
            $is_data = Event::orderBy('updated_at', 'desc')->limit($limit)->offset(($page - 1) * $limit)->get()->toArray();
        }
        // $is_data = Event::all();
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
            'date_event' => 'required',
            'description' => 'required',
            'location' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $is_data = new Event();
        $is_data->name = $request->input('name');
        $is_data->image = $request->input('image');
        $is_data->date_event = $request->input('date_event');
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
        $is_data = Event::find($id);
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
            'date_event' => 'required',
            'description' => 'required',
            'location' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $is_data = Event::find($id);
        $is_data->name = $request->input('name');
        $is_data->image = $request->input('image');
        $is_data->date_event = $request->input('date_event');
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
        $is_data = Event::find($id);
        $is_data->delete();
        return $this->jsonResponse(
            true,
            'Event Deleted Successfully',
            [],
            200
        );
    }
}