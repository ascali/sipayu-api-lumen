<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'destinations';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_toi',
        'name',
        'image',
        'contact',
        'description',
        'location',
        'latitude',
        'longitude'
    ];
}
