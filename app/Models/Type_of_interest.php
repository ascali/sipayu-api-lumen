<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Type_of_interest extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'type_of_interests';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_parent',
        'name',
        'image',
        'description'
    ];
}
