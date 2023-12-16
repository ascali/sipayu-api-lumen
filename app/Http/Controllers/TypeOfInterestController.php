<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function list_dt(Request $request)
    {
        $orderby = $request->input('order.0.column');
        $sort['col'] = $request->input('columns.' . $orderby . '.data');    
        $sort['dir'] = $request->input('order.0.dir');

        $query = DB::table('type_of_interests')
            ->select(
                'type_of_interests.id',
                'type_of_interests.name',
                'type_of_interests.image',
                'type_of_interests.description',
                'type_of_interests.created_at',
            )
            ->whereNull('type_of_interests.deleted_at')
            ->where(function ($query) use ($request) {
                $query->where('type_of_interests.name', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('type_of_interests.image', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('type_of_interests.description', 'like', '%'. $request->input('search.value') .'%');
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