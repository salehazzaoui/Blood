<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    protected $fillabel =[
        'name',
        'arbic_name',
        'post_code',
        'wilaya_id',
        'latitude',
        'longitude'
    ];
}
