<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Destination;

class DestinationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login', 'refresh', 'logout']]);
    }

    public function index(Request $request)
    {
        $is_data = [];
        $page = $request->input('page') != '' ? $request->input('page') : 1;
        $limit = $request->input('limit') != '' ? $request->input('limit') : 10;
        $id_toi = $request->input('id_toi');

        if ($request->input('page')!='' && $request->input('limit')!='' && $request->input('id_toi')!='') {
            $is_data = Destination::orderBy('id', 'desc')->where('id_toi', $id_toi)->limit($limit)->offset(($page - 1) * $limit)->get()->toArray();
            foreach ($is_data as $key => $value) {
                $rating = DB::select("select ROUND( AVG(r.rating)::numeric, 2 ) as rating from ratings r where r.id_destination = ? limit 1;", [$value['id']]);
                $review = DB::select("select COUNT(r.id) as review from reviews r where r.id_destination = ? limit 1;", [$value['id']]);
                $is_data[$key]['rating'] = count($rating) > 0 ? (float) $rating[0]->rating : 0;
                $is_data[$key]['review'] = count($review) > 0 ? (int) $review[0]->review : 0;
            }
        } else {
            $is_data = Destination::all();
        }
        return $this->jsonResponse(
            true,
            'Success',
            $is_data,
            200
        );
    }

    public function list(Request $request)
    {
        $is_data = [];
        $page = $request->input('page') != '' ? $request->input('page') : 1;
        $limit = $request->input('limit') != '' ? $request->input('limit') : 10;
        $id_toi = $request->input('id_toi');

        // if ($request->input('limit')!='' ) {
        //     $is_data = Destination::orderBy('updated_at', 'desc')->limit($limit);
        // }
        // if ($request->input('page')!='' && $request->input('limit')!='') {
        //     // $is_data = Destination::orderBy('updated_at', 'desc')->paginate($page);
        //     $is_data = Destination::orderBy('updated_at', 'desc')->limit($limit)->offset(($page - 1) * $limit)->get()->toArray();
        // }
        if ($request->input('page')!='' && $request->input('limit')!='' && $request->input('id_toi')!='') {
            $is_data = Destination::orderBy('updated_at', 'desc')->where('id_toi', $id_toi)->limit($limit)->offset(($page - 1) * $limit)->get()->toArray();
            foreach ($is_data as $key => $value) {
                $rating = DB::select("select ROUND( AVG(r.rating)::numeric, 2 ) as rating from ratings r where r.id_destination = ? limit 1;", [$value['id']]);
                $review = DB::select("select COUNT(r.id) as review from reviews r where r.id_destination = ? limit 1;", [$value['id']]);
                $is_data[$key]['rating'] = count($rating) > 0 ? (float) $rating[0]->rating : 0;
                $is_data[$key]['review'] = count($review) > 0 ? (int) $review[0]->review : 0;
            }
        }

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

        $query = DB::table('destinations')
            ->join('type_of_interests', 'destinations.id_toi', '=', 'type_of_interests.id')
            ->select(
                'destinations.id',
                'destinations.id_toi',
                'destinations.name',
                'type_of_interests.name as type_of_interests_name',
                'destinations.image',
                'destinations.contact',
                'destinations.description',
                'destinations.location',
                'destinations.latitude',
                'destinations.longitude',
                'destinations.created_at',
            )
            ->whereNull('destinations.deleted_at')
            ->where(function ($query) use ($request) {
                $query->where('destinations.name', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('destinations.image', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('destinations.contact', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('destinations.description', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('destinations.location', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('destinations.latitude', 'like', '%'. $request->input('search.value') .'%')
                ->orWhere('destinations.longitude', 'like', '%'. $request->input('search.value') .'%');
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
            'id_toi' => 'required',
            'name' => 'required',
            'image' => 'required',
            'contact' => 'required',
            'description' => 'required',
            'location' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $is_data = new Destination();
        $is_data->id_toi = $request->input('id_toi');
        $is_data->name = $request->input('name');
        $is_data->image = $request->input('image');
        $is_data->contact = $request->input('contact');
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
        $is_data = Destination::find($id);
        $rating = DB::select("select ROUND( AVG(r.rating)::numeric, 2 ) as rating from ratings r where r.id_destination = ? limit 1;", [$id]);
        $review = DB::select("select COUNT(r.id) as review from reviews r where r.id_destination = ? limit 1;", [$id]);
        $is_data['rating'] = count($rating) > 0 ? (float) $rating[0]->rating : 0;
        $is_data['review'] = count($review) > 0 ? (int) $review[0]->review : 0;
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
            'id_toi' => 'required',
            'name' => 'required',
            'image' => 'required',
            'contact' => 'required',
            'description' => 'required',
            'location' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $is_data = Destination::find($id);
        $is_data->id_toi = $request->input('id_toi');
        $is_data->name = $request->input('name');
        $is_data->image = $request->input('image');
        $is_data->contact = $request->input('contact');
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
        $is_data = Destination::find($id);
        $is_data->delete();
        return $this->jsonResponse(
            true,
            'Destination Deleted Successfully',
            [],
            200
        );
    }
}