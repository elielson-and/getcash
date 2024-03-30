<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_documentation = User::with('document')->find(Auth::id());
        // $doc = new Document();
        return Inertia::render('Client/Documentation', ['documentation' => $user_documentation->document]);
        // dd($user->document->client_selfie_img);
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
            $doc = new Document();
            $doc->cpf = $request->cpf;
            $doc->fullName = $request->fullName;
            $doc->gender = $request->gender;
            $doc->birth_date = $request->birthDate;
            $doc->phone = $request->phone;
            $doc->email = $request->email;
            $doc->address = $request->address;
            $doc->status = 'analysis'; // analysis/approved/revoked null = pending
            $doc->user_id = Auth::user()->id;

            if ($request->hasFile('rg_img')) {
                $rgImage = $request->file('rg_img');
                $rgImageName = 'rg_' . time() .  random_int(00000000, 99999999) . '.' . $rgImage->getClientOriginalExtension();
                $rgImage->storeAs('public/images', $rgImageName);
                $doc->client_rg_img = $rgImageName;
            }

            if ($request->hasFile('selfie_img')) {
                $selfieImage = $request->file('selfie_img');
                $selfieImageName = 'selfie_' . time() . random_int(00000000, 99999999) . '.' . $selfieImage->getClientOriginalExtension();
                $selfieImage->storeAs('public/images', $selfieImageName);
                $doc->client_selfie_img = $selfieImageName;
            }

            $doc->save();

            // return Inertia::render('Client/Documentation', ['status' => 'sent_success']);
            return redirect()->route('documentacao');
        } catch (\Throwable $th) {
            return Inertia::render('Client/Documentation', ['status' => ['sent_failed' => $th]]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function status()
    {
        $user_documentation = User::with('document')->find(Auth::id());
        // $doc = new Document();
        return Inertia::render('Client/Documentation', ['documentation' => $user_documentation->document]);
        // dd($user->document->client_selfie_img);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}