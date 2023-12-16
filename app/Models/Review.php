<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'reviews';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_user',
        'id_destination',
        'id_rating',
        'id_review_image',
        'review',
        'image'
    ];
}
