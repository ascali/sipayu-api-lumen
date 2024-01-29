<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\E_brosure;

class EbrosureController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['register', 'login', 'refresh', 'logout']]);
    }

    public function index(Request $request)
    {
        $is_data = [];
        $page = $request->input('page') != '' ? $request->input('page') : 1;
        $limit = $request->input('limit') != '' ? $request->input('limit') : 5;

        if ($request->input('page')!='' && $request->input('limit')!='') {
            $is_data = E_brosure::orderBy('efective', 'asc')->limit($limit)->offset(($page - 1) * $limit)->get()->toArray();
        }
        // $is_data = E_brosure::all();
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

        $query = DB::table('e_brosures')
            ->select(
                'e_brosures.id',
                'e_brosures.name',
                'e_brosures.image',
                'e_brosures.description',
                'e_brosures.efective',
                'e_brosures.expired',
                'e_brosures.latitude',
                'e_brosures.longitude',
                'e_brosures.created_at'
            )
            ->whereNull('e_brosures.deleted_at')
            ->where(function ($query) use ($request) {
                $query->where('e_brosures.name', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('e_brosures.image', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('e_brosures.description', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('e_brosures.efective', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('e_brosures.expired', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('e_brosures.latitude', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('e_brosures.longitude', 'like', '%'. $request->input('search.value') .'%');
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
            'description' => 'required',
            'image' => 'required',
            'efective' => 'required',
            'expired' => 'required',
        ]);

        $is_data = new E_brosure();
        $is_data->name = $request->input('name');
        $is_data->description = $request->input('description');
        $is_data->image = $this->uploadToStorage($request->input('image'));
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
        $is_data = E_brosure::find($id);
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
            'description' => 'required',
            'image' => 'required',
            'efective' => 'required',
            'expired' => 'required',
        ]);

        $is_data = E_brosure::find($id);
        $is_data->name = $request->input('name');
        $is_data->description = $request->input('description');
        $is_data->image = $this->uploadToStorage($request->input('image'));
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
        $is_data = E_brosure::find($id);
        $is_data->delete();
        return $this->jsonResponse(
            true,
            'Brosure Deleted Successfully',
            [],
            200
        );
    }
}