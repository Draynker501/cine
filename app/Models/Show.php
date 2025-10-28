<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Show extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'movie_id',
        'hall_id',
        'start_time',
        'ticket_price',
        'points_value',
    ];
}
