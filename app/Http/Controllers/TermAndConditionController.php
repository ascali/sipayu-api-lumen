<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Term_and_condition;

class TermAndConditionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login', 'refresh', 'logout']]);
    }

    public function list(Request $request)
    {
        $orderby = $request->input('order.0.column');
        $sort['col'] = $request->input('columns.' . $orderby . '.data');    
        $sort['dir'] = $request->input('order.0.dir');

        $query = Term_and_condition::select(
                'id',
                'name',
                'description',
                'created_at',
            )
            ->whereNull('deleted_at')
            ->where(function ($query) use ($request) {
                $query->where('name', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('description', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('created_at', 'like', '%'. $request->input('search.value') .'%');
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

    public function index()
    {
        $is_data = Term_and_condition::all();
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
            'description' => 'required'
        ]);

        $is_data = new Term_and_condition();
        $is_data->name = $request->input('name');
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
        $is_data = Term_and_condition::find($id);
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
            'description' => 'required'
        ]);

        $is_data = Term_and_condition::find($id);
        $is_data->name = $request->input('name');
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
        $is_data = Term_and_condition::find($id);
        $is_data->delete();
        return $this->jsonResponse(
            true,
            'Data Deleted Successfully',
            [],
            200
        );
    }
}