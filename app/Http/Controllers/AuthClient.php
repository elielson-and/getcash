<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthClient extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function auth(Request $request): RedirectResponse
    {
        $client = Client::where('cpf', $request->cpf)->first();
        if ($client) {
            // Faz o login do usuário baseado na instância do modelo
            Auth::login($client);

            // Redireciona o usuário autenticado para a dashboard ou painel do cliente
            return redirect()->intended(RouteServiceProvider::HOME_CLIENT);
        } else {
            dd('merda');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
