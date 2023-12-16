<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Advertisment;

class AdvertismentController extends Controller
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

        if ($request->input('page')!='' && $request->input('limit')!='') {
            $is_data = Advertisment::orderBy('efective', 'asc')->limit($limit)->offset(($page - 1) * $limit)->get()->toArray();
        }
        // $is_data = Advertisment::all();
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

        $query = DB::table('advertisments')
            ->select(
                'advertisments.id',
                'advertisments.name',
                'advertisments.type',
                'advertisments.image',
                'advertisments.url',
                'advertisments.description',
                'advertisments.efective',
                'advertisments.expired',
                'advertisments.latitude',
                'advertisments.longitude',
                'advertisments.created_at',
            )
            ->whereNull('advertisments.deleted_at')
            ->where(function ($query) use ($request) {
                $query->where('advertisments.name', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('advertisments.type', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('advertisments.image', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('advertisments.url', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('advertisments.description', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('advertisments.efective', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('advertisments.expired', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('advertisments.latitude', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('advertisments.longitude', 'like', '%'. $request->input('search.value') .'%');
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
            'type' => 'required',
            'image' => 'required',
            'url' => 'required',
            'efective' => 'required',
            'expired' => 'required',
        ]);

        $is_data = new Advertisment();
        $is_data->name = $request->input('name');
        $is_data->type = $request->input('type');
        $is_data->image = $request->input('image');
        $is_data->url = $request->input('url');
        $is_data->description = $request->input('description');
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
        $is_data = Advertisment::find($id);
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
            'type' => 'required',
            'image' => 'required',
            'url' => 'required',
            'efective' => 'required',
            'expired' => 'required',
        ]);

        $is_data = Advertisment::find($id);
        $is_data->name = $request->input('name');
        $is_data->type = $request->input('type');
        $is_data->image = $request->input('image');
        $is_data->url = $request->input('url');
        $is_data->description = $request->input('description');
        $is_data->efective = $request->input('efective');
        $is_data->expired = $request->input('expired');
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
        $is_data = Advertisment::find($id);
        $is_data->delete();
        return $this->jsonResponse(
            true,
            'Advertisment Deleted Successfully',
            [],
            200
        );
    }
}