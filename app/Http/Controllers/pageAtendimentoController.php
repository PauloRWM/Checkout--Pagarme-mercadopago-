<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class pageAtendimentoController extends Controller
{
   public function index($planoId, $company, $email){
     $response = Http::get($_ENV['URLATENDIMENTO'].'/plans/all');
     $plans = $response->json();
 //dd($plans);
     foreach ($plans as $plano)
        //dd($plano['id']);
        {
            if ($plano['id'] == $planoId){
            return view('atendimento', ['plano' => $plano,'planos'=>$plans,'company'=>$company,'email'=>$email]);
            }


        }

    }
}
