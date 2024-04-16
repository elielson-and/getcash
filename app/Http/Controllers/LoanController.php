<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        return Inertia::render('Client/RequestLoan', ['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Loan::create([
                'value' => $request->value,
                'user_id' => Auth::id(),
                'installment_amount' => $request->installment_amount,
                'installment_value' => $request->installment_value,
                'payment_day' => $request->payment_day
            ]);

            return Inertia::render('Client/RequestLoan', ['success' => true]);
        } catch (\Throwable $th) {
            return Inertia::render('Client/RequestLoan', ['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        $user_id = Auth::id();
        $loan = User::with('loan.loanStatus')
            ->where('id', $user_id)
            ->first()
            ->loan
            ->load('loanStatus');
        return response()->json($loan, 200);
        // $loan = User::with('loan.loanStatus')->find($user_id)->loan()->first();
        // $document = User::find($user_id)->document()->with('status')->first();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
