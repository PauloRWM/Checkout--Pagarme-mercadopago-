<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class PixController extends Controller
{
    public function pixGet(){
        $meio = Request::post("pagamento");


        $nome = Request::post('nome');
        $email = Request::post('email');
        $numero = Request::post('numero');
        $ddd = Request::post('ddd');
        $estado = Request::post('estado');
        $cidade = Request::post('cidade');
        $cep = Request::post('cep');
        $endereco = Request::post('rua');
        $cpf = Request::post('cpf');
        $valor = 1;



     if ($meio==="pix"){

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.pagar.me/core/v5/orders',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "items": [
                {
                    "amount": '.$valor.',
                    "description": "Pagamento Plano com PIX",
                    "code":"123",
                    "quantity": 1
                }
            ],
            "customer": {
                "name": "'.$nome.'",
                "email": "'.$email.'",
                "type": "individual",
                "document": "'.$cpf.'",
                "phones": {
                    "home_phone": {
                        "country_code": "55",
                        "number": "'.$numero.'",
                        "area_code": "'.$ddd.'"
                            }
                        }
                    },
                    "payments": [
                        {
                            "payment_method": "pix",
                            "Pix": {
                                "expires_in": 90000
                    }


                        }
                    ]
                }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic ' . $_ENV['PAGARMETOKEN'] . '',
            'Cookie: __cf_bm=sR35QBuxwdCJ.O5g8T76Gww6xX8xKOjl9oOMAN2qjsg-1696460587-0-AZjbCgTfkk1zXsYHrnu4bduoHwU2mZ/bdcW6efBQGNhiNJLlMZqdzxNOz11dNP+rSNY4NQa3YZPffBm0yLSXiOI='
        ),
        ));

        $response = json_decode(curl_exec($curl)) ;
       // logMsg("Pagamento com pix".$response,"ReqPgt.log");
        //$response = json_decode ($response);


        //$dados = $response->charges[0]->last_transaction;



        curl_close($curl);
        $pixURL = $response->charges[0]->last_transaction->qr_code_url;
        $pixCode = $response->charges[0]->last_transaction->qr_code;


        $pixDados = [
           [ "code"=>$pixCode,
            "url" =>$pixURL,
            "ordem"=>$response->id
            ]

        ];
        print_r(json_encode($pixDados,JSON_PRETTY_PRINT));
        //dd(($response));
        //echo();


        }










    }
}
