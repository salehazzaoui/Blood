<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'image',
    ];

    public function admin(){
        return $this->belongsTo(User::class);
    }
}
