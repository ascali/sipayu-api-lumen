<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Advertisment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'advertisments';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'type',
        'image',
        'url',
        'description',
        'efective',
        'expired',
        'latitude',
        'longitude',
        'status',
        'type_ads',
        'price_ads',
        'name_advertiser',
        'email_advertiser',
        'telp_advertiser',
        'impression',
        'clicked',
    ];
}
