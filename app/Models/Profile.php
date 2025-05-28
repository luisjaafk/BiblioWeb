<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id', 'avatar', 'bio', 'website', 'location', 'birthdate'
    ];

    // Relación inversa con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
