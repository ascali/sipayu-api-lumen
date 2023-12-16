<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class E_brosure extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'e_brosures';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'efective',
        'expired',
        'latitude',
        'longitude',
    ];
}
