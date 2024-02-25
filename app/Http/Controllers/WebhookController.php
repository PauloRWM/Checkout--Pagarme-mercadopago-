<?php

namespace App\Http\Controllers;

use App\Models\ordens;
use Illuminate\Support\Facades\Request;


class WebhookController extends Controller
{
    public function activePlan()
    {
        $ordens = new ordens();
        $dadosBd = $ordens::where('ordem_id', Request::input("id"))->get();

        // printf($dadosBd[0]->company);


        if (isset($dadosBd[0]->company) && isset($dadosBd[0]->plano)) {
            if (Request::input("status") === "paid" && $dadosBd[0]->meio==="pagarme") {

                $ordens->where("ordem_id",Request::input("id"))->update(['status' => "pago"]);
                //$ordens->save();
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $_ENV['URLATENDIMENTO'] . '/auth/planoAlterado',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_HTTPHEADER => array(
                        'token: ' . $_ENV['TOKENATENDIMENTO'] . '',
                        'companyid: ' . $dadosBd[0]->company . '',
                        'planid: ' . $dadosBd[0]->plano . ''
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                echo $response;
            }
            if ( $dadosBd[0]->meio==="mercadopago") {

                $ordens->where("ordem_id",Request::input("id"))->update(['status' => "pago"]);
                //$ordens->save();
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $_ENV['URLATENDIMENTO'] . '/auth/planoAlterado',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_HTTPHEADER => array(
                        'token: ' . $_ENV['TOKENATENDIMENTO'] . '',
                        'companyid: ' . $dadosBd[0]->company . '',
                        'planid: ' . $dadosBd[0]->plano . ''
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                echo $response;
            }
        }
    }
}
