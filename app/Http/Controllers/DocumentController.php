<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Client/Documentation');
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
        // $request->validate()
        // dd($request);
        $doc = new Document();
        $doc->cpf = $request->cpf;
        $doc->fullName = $request->fullName;
        $doc->gender = $request->gender;
        $doc->birth_date = $request->birthDate;
        $doc->phone = $request->phone;
        $doc->email = $request->email;
        $doc->address = $request->address;
        $doc->save();

        return Inertia::render('Client/Documentation', ['status' => 'sent_success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
