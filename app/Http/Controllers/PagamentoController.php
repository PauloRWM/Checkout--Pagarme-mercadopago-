<?php

namespace App\Http\Controllers;

use App\Models\ordens;
use Illuminate\Support\Facades\Request;

class PagamentoController extends Controller
{
    public function index()
    {
        $ordens = new ordens();






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
        $company=Request::post('company');
        $idplano=Request::post('idplano');
        $valor = 1;


                $ordens->nome = $nome;
                $ordens->cpf = $cpf;
                $ordens->email = $email;
                $ordens->ddd = $ddd;
                $ordens->telefone = $numero;
                $ordens->estado = $estado;
                $ordens->cidade = $cidade;
                $ordens->endereco = $endereco;
                $ordens->cep = $cep;
                $ordens->company = $company;
                $ordens->plano = $idplano;


        //   $_ENV['PAGARMETOKEN'],
        if ($meio === "pagarme") {
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
                CURLOPT_POSTFIELDS => '{
            "items": [
                {
                    "amount": "' . $valor . '",
                    "description": "EnviaWhats",
                    "code":"123",
                    "quantity": 1
                }
            ],
            "customer": {
                "name": "' . $nome . '",
                "email": "' . $email . '",
                "type": "individual",
                "document": "' . $cpf . '",
                "phones": {
                    "home_phone": {
                        "country_code": "55",
                        "number": "' . $numero . '",
                        "area_code": "' . $ddd . '"
                    }
                },
                "address": {
                    "country": "BR",
                    "state": "' . $estado . '",
                    "city": "' . $cidade . '",
                    "zip_code": "' . $cep . '",
                    "line_1": "' . $endereco . '"
                  }
            },
            "payments": [
                {
                    "payment_method": "checkout",
                    "checkout": {
                        "expires_in":120,
                        "billing_address_editable" : false,
                        "customer_editable" : true,
                        "accepted_payment_methods": ["pix","credit_card"],
                        "success_url": "https://checkout.enviawhats.com/concluido.php",
                        "Pix": {
                        "expires_in": 3600
            },


                }


                }
            ]
        }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Basic ' . $_ENV['PAGARMETOKEN'] . '',
                    'Cookie: __cf_bm=AqlOT1AOX4l719H.EtVnACn3EYEhROAR6XSAJkFQiv0-1696437107-0-ASus8+F/+HBzdNxhDRUo1S6jCmqOAqRh3uwn8ti9tA/CgtQbrF3unnqzx3uplfEL1s8Q0p41VyU/Qb/gzQW2oas='
                ),
            ));

            $response = curl_exec($curl);
            //logMsg("Pagamento com Pargarme".$response,"ReqPgt.log");
            $response = json_decode($response);

           // dd  ($response);



            curl_close($curl);
            //      d ($response);
            //      d ($valor);
            //   $checkout = $response->checkouts[0]->payment_url;
            // registrodb($response->checkouts[0]->id);
            // sleep(2);
            // header("location:$checkout");

                $ordens->ordem_id = $response->id;
                $ordens->meio = "pagarme";


















         //    dd($response);

        $ordens->save();
            return redirect()->away($response->checkouts[0]->payment_url);
        }



        if ($meio === 'mercadopago') {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.mercadopago.com/checkout/preferences',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                "items": [
                {
                "title": "EnviaWhats",
                "description": "EnviaWhats Plataforma de atendimento",
                "picture_url": "https://enviawhats.com/uploads/23/10/1696475400Tezf7LXQf0rEEF1wyj58.png",
                "category_id": "others",
                "quantity": 1,
                "currency_id": "R$",
                "unit_price": '.$valor.'
                }
                ],
                "payer": {
                    "phone": {},
                    "email": "' . $email . '"
                    "identification": {},
                    "address": {}
                },
                "external_reference":"' . $email . '"
                "payment_methods": {
                    "excluded_payment_methods": [
                    {}
                    ],
                    "excluded_payment_types": [
                    {"id": "ticket"}
                    ]
                },
                "shipments": {
                    "free_methods": [
                    {}
                    ],
                    "receiver_address": {}
                },
                "back_urls": {
                    "success":"https://checkout.enviawhats.com/concluido.php"
                },
                "differential_pricing": {},
                "metadata": {}
                }',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $_ENV['TOKENMERCADOPAGO'] . '',
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);
            //d($response);


            $response = json_decode($response);

            // registrodb($response->checkouts[0]->id);

            curl_close($curl);
           // dd($response);
            // $checkout = $response->init_point;
            //header("location:$checkout");
            // exit;
                $ordens->ordem_id = $response->id;
                $ordens->meio = "mercadopago";
                $ordens->save();
            return redirect()->away($response->init_point);
        }






    }
}
