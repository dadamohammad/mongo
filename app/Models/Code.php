<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Code extends Model
{
    use HasFactory;

    protected $fillable = [
        'rand_code',
        'user',
        'mobile',
        'verified_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
