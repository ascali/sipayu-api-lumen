<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use App\Models\Destination;

class DestinationController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['register', 'login', 'refresh', 'logout']]);
    }

    public function list(Request $request)
    {
        // Mengambil parameter request
        $page  = $request->input('page') ?: 1;
        $limit = $request->input('limit') ?: 10;
        
        // Membuat cache key yang unik berdasarkan semua parameter request
        $cacheKey = 'destination_list_' . md5(json_encode($request->all()));
        
        // Cek apakah hasil query sudah ada di cache Redis
        if ($cachedData = Redis::connection('default')->get($cacheKey)) {
            // Jika ada, kembalikan data dari cache
            return $this->jsonResponse(
                true,
                'Success (from cache)',
                json_decode($cachedData, true),
                200
            );
        }
    
        // Jika data belum dicache, lakukan query ke database
        $query = Destination::query();
        $query = $query->select(
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
            'destinations.created_at'
        );
    
        $query = $query->join('type_of_interests', 'destinations.id_toi', '=', 'type_of_interests.id');
        $query = $query->whereNull('destinations.deleted_at');
    
        // Filter berdasarkan id_toi jika ada
        if ($request->has('id_toi')) {
            $query->where('destinations.id_toi', '=', $request->input('id_toi'));
        }
    
        // Filter berdasarkan search (pencarian)
        if ($request->has('search')) {
            $search = strtolower($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(destinations.name) LIKE ?', ['%' . $search . '%'])
                  ->orWhereRaw('LOWER(destinations.description) LIKE ?', ['%' . $search . '%'])
                  ->orWhereRaw('LOWER(destinations.location) LIKE ?', ['%' . $search . '%']);
            });
        }
    
        // Eksekusi query dengan paginasi
        $results = $query->orderBy('destinations.id', 'desc')
                         ->limit($limit)
                         ->offset(($page - 1) * $limit)
                         ->get()
                         ->toArray();
    
        // Untuk setiap destination, ambil rating dan review terkait
        foreach ($results as $key => $value) {
            $rating = DB::select(
                "SELECT ROUND(AVG(r.rating)::numeric, 2) as rating 
                 FROM ratings r 
                 WHERE r.id_destination = ? LIMIT 1",
                 [$value['id']]
            );
            $review = DB::select(
                "SELECT COUNT(r.id) as review 
                 FROM reviews r 
                 WHERE r.id_destination = ? LIMIT 1",
                 [$value['id']]
            );
    
            $results[$key]['rating'] = !empty($rating) ? (float) $rating[0]->rating : 0;
            $results[$key]['review'] = !empty($review) ? (int) $review[0]->review : 0;
        }
    
        // Simpan hasil query ke Redis dengan masa berlaku (misalnya 60 detik)
        Redis::connection('default')->setex($cacheKey, 60, json_encode($results));
        // Kembalikan hasil response
        return $this->jsonResponse(
            true,
            'Success',
            $results,
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
        
        $images = $request->input('image');

        if (count(json_decode($images)) > 0) {
            $isImage = [];
            for ($i=0; $i < count(json_decode($images)); $i++) { 
                $toStorage = $this->uploadToStorageMinio(json_decode($images)[$i]);
                array_push($isImage, $toStorage);
            }
            $images = json_encode($isImage);
        } else {
            $images = $this->uploadToStorageMinio($request->input('image'));
        }

        $is_data = new Destination();
        $is_data->id_toi = $request->input('id_toi');
        $is_data->name = $request->input('name');
        $is_data->image = $images;
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

        $images = $request->input('image');

        if (count(json_decode($images)) > 0) {
            $isImage = [];
            for ($i=0; $i < count(json_decode($images)); $i++) { 
                $toStorage = $this->uploadToStorageMinio(json_decode($images)[$i]);
                array_push($isImage, $toStorage);
            }
            $images = json_encode($isImage);
        } else {
            $total = count(json_decode($images));
            $images = $total == 1 ? $this->uploadToStorageMinio($request->input('image')) : '';
        }

        $is_data = Destination::find($id);
        $is_data->id_toi = $request->input('id_toi');
        $is_data->name = $request->input('name');
        $is_data->image = $images;
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