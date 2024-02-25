<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pixStatusController extends Controller
{
    public function index($ordem)
    {
        //dd("ko");
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.pagar.me/core/v5/orders/' . $ordem . '',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic ' . $_ENV['PAGARMETOKEN'] . '',
            ),
        ));

        $response = json_decode(curl_exec($curl));

        curl_close($curl);

        $pixDados = [
            [
                "status" => $response->status,
            ]

        ];
        print_r(json_encode($pixDados, JSON_PRETTY_PRINT));



        //echo ($response);
    }
}
