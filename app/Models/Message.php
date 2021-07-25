<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'recipient_email',
        'body'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class);
    }
}
