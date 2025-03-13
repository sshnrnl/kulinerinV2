<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointLoyalty extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'point',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
