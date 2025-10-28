<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowSeat extends Model
{
    use HasFactory;

    protected $fillable = [
        'show_id',
        'seat_id',
        'status',
    ];
}
