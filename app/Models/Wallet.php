<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'balance', 'score', 'pix_key', 'max_available_value'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
