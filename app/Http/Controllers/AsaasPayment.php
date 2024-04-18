<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AsaasPayment extends Controller
{

    //test
    //protected $asaas_token = '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwNzg3MjY6OiRhYWNoXzI5YmZiZDQ1LTk3NDAtNGE1NC1iODc3LTM1YTM1Mjc1MTYwOA==';
    //prod
    protected $asaas_token = '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDA0MTQ2MzE6OiRhYWNoXzAwYTBkYTExLTU3ZDktNDYyZC1iOTZlLTc2NDMzMWM3ZWVkMA==';
    protected  $asaas_endpoint = 'https://api.asaas.com/'; // test = https://sandbox.asaas.com/api

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
    public function create(Request $request)
    {
        try {
            $response = Http::withHeaders([
                'accept' => 'application/json',
                'access_token' => $this->asaas_token,
                'content-type' => 'application/json',
            ])->post($this->asaas_endpoint.'/v3/pix/qrCodes/static',[
                'value'=> 0.1,
                'description'=> "descrricao teste"
            ]);

            if ($response->successful()) {
                // Aqui estamos assumindo que a resposta é um JSON e decodificamos ela
                $data = $response->json();
                // Enviamos o JSON já como um array associativo para o frontend
                return response()->json(['pix' => $data], 200);
            } else {
                // Caso a resposta não seja bem sucedida, retornamos o erro
                return response()->json(['error' => 'Failed to retrieve data'], $response->status());
            }
        } catch (\Exception $exception) {
            // Se algo der errado no processo, retornamos o erro
            return response()->json(['error' => $exception->getMessage()], 500);
        }
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
