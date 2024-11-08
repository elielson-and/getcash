<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;


    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function request()
    {
        return $this->belongsTo(Request::class);
    }
}
