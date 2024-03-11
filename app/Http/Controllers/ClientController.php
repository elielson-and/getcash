<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class ClientController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function auth(Request $request)
    {
        $client = Client::where('cpf', $request->cpf)->first();
        if ($client) {
            // Faz o login do usuário baseado na instância do modelo
            Auth::login($client, true);

            // Redireciona o usuário autenticado para a dashboard ou painel do cliente
            // return redirect()->intended(RouteServiceProvider::HOME_CLIENT);
            return Inertia::render('Teste', ['teste' => true]);
        }

        throw ValidationException::withMessages([
            'cpf' => trans('cpf.failed'),
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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
