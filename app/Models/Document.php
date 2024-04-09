<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'cpf',
        'fullName',
        'gender',
        'birth_date',
        'phone',
        'email',
        'address',
        'client_selfie_img',
        'client_rg_img',
        'status',
        'revocation_reason'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function documents()
    {
        return $this->hasMany(Document::class, 'status');
    }
}
