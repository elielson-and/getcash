<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'user_id',
        'installment_amount',
        'current_installment',
        'installment_value',
        'loan_status_id',
        'current_interest',
        'payment_day'
    ];


    public function loanStatus()
    {
        return $this->belongsTo(LoanStatus::class);
    }
}
