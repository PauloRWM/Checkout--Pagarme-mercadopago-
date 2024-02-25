@php
use Illuminate\Support\Facades\Http;

$response = Http::get('https://api.enviawhats.com/plans/all');
$plans = $response->json();
@endphp



<html lang="pt-br">

<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100;0,9..40,200;0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;0,9..40,900;0,9..40,1000;1,9..40,100;1,9..40,200;1,9..40,300;1,9..40,400;1,9..40,500;1,9..40,600;1,9..40,700;1,9..40,800;1,9..40,900;1,9..40,1000&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        body {
            color: #1c1e21 !important;
            font-family: "DM Sans" !important;
        }

        .form-control {
            border: 1px solid #e9edf7 !important;
            border-radius: 5px !important;
            height: 45px !important;
        }

        .custom-radio .custom-control-input:checked~.custom-control-label::before {
            background-color: #25d366 !important;
        }

        .span-pricing {
            background: #ff0000d4;
            color: #ffffff;
            padding: 8px 14px 8px 10px;
            display: inline-block;
            font-size: 15px;
            margin: auto;
            display: block;
            text-align: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            font-weight: 500;
        }

        .span-teste-gratis {
            color: #1d1d1d;
            background: #fffbef;
            padding: 1px 5px;
            border-radius: 16px;
            font-weight: bold;
        }

        .img-teste-gratis {
            width: 18px;
            height: auto;
            margin-right: 5px;
            margin-left: 2px;
            position: relative;
            top: -2px;
        }

        .usuarios-comprando {
            background: #25d366;
            color: white;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            padding: 5px;
        }
    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://enviawhats.com/uploads/favicon.png">

    <title>Finalizar Compra - EnviaWhats</title>

    <!-- Principal CSS do Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


    <!-- Estilos customizados para esse template -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">
    <link href="{{ url('/') }}/css/styles.css" rel="stylesheet">

    <style>
        undefined
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin="use-credentials">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mulish:wght@200;300;400;500;600;700;800;900&amp;display=swa">
</head>

<body class="bg-light" style="background-color: #ffffff!important;" cz-shortcut-listen="true">


    <div id="pageMessages">

    </div>





    <div class="container justify-content-center">
        <!-- <div class="text-center" style="margin-top: 50px;">
            <img class="d-block mx-auto mb-4" src="https://enviawhats.com/uploads/23/10/1696478434XdvsU33AeqbcAAhgqtgY.png" alt="Logo EnviaWhats" width="250"
                height="auto">

        </div>
        -->

        <div class="col-md-8 order-md-1" style="display: flex;flex-direction: column;width: 100%;position: relative;min-width: 0px;overflow-wrap: break-word;border-radius: 20px;padding: 34px;margin: auto;">
            <h2 style="text-align: center;margin-bottom: 30px;font-size: 36px;color: #1b254b;font-weight: 900;">Finalize sua compra
                <hr>
            </h2>
            <p style="text-align: center;margin-bottom: 30px;margin-top: -20px;">Preencha todos os campos abaixo corretamente</p>
            <form class="needs-validation" id="formuariodeenvio" novalidate="" action="/pagamento" method="post">
                <div class="row">
                    @csrf
                    <div class="col-md-6 mb-3">
                        <label for="primeiroNome" style="display:none;">Nome Completo</label>
                        <input type="text" required="" class="form-control" id="primeiroNome" name="nome" placeholder="Nome completo" value="">
                        <div class="invalid-feedback">
                            É obrigatório inserir um nome válido.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cpf" style="display:none;">CPF</label>
                        <input type="text" required="" class="form-control" id="cpf" name="cpf" placeholder="CPF" value="">
                        <div class="invalid-feedback">
                            É obrigatório inserir um sobre CPF válido.
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3" style="padding-left: 0px;float: left;">
                    <label for="email" style="display:none;">Email</label>
                    <div class="input-group">
                        <!-- <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div> -->
                        <input readonly="" type="text" required="" class="form-control bloqueioinput" id="email" name="email" value="paulosateste@gmail.com" placeholder="E-mail">
                        <div class="invalid-feedback" style="width: 100%;">
                            Seu email é obrigatório.
                        </div>
                    </div>
                </div>


                <div class="mb-3 row">


                    <div class="col-md-4 mb-3">

                        <label for="endereco2" style="display:none;">DDD<span class="text-muted"></span></label>
                        <input required="" type="text" maxlength="2" class="form-control" name="ddd" id="endereco2" placeholder="DDD">


                    </div>
                    <div class="col-md-8 mb-3" style="padding-right: 0;">

                        <label for="endereco2" style="display:none;">Telefone<span class="text-muted"></span></label>
                        <input type="text" name="numero" class="form-control" id="endereco2" placeholder="Whatsapp">


                    </div>





                </div>



                <div class="mb-3 row">


                    <div class="col-md-2 mb-3">

                        <label for="endereco2" style="display:none;">Estado<span class="text-muted"></span></label>

                        <select class="form-control" name="estado" id="estado">
                            <option value="">UF</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espirito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>



                        </select>
                    </div>
                    <div class="col-md-4 mb-3">

                        <label for="endereco2" style="display:none;">Cidade<span class="text-muted"></span></label>
                        <input required="" type="text" name="cidade" class="form-control" id="endereco2" placeholder="Cidade">


                    </div>
                    <div class="col-md-4 mb-3">

                        <label for="endereco2" style="display:none;">Endereço<span class="text-muted"></span></label>
                        <input required="" type="text" name="rua" class="form-control" id="endereco2" placeholder="Endereço">


                    </div>

                    <div class="col-md-2 mb-3">

                        <label for="endereco2" style="display:none;">CEP<span class="text-muted"></span></label>
                        <input required="" type="text" name="cep" class="form-control" id="endereco2" placeholder="CEP">


                    </div>


                </div>

















                <hr>
                <p id="tituloplanolabel" style="display: none;">Selecione a plataforma e o plano que deseja assinar:</p>
                <div id="plataformalist " class="row fade-in" style="background: #ffffff;border-radius: 7px;margin-bottom: 15px;">


                    <div class="d-block my-3 col-6">
                        <div id="divgpt" class="custom-control custom-radio" hidden="">
                            <input id="gpt" name="plataform" type="radio" class="custom-control-input" required="" value="gpt">
                            <label class="custom-control-label" for="gpt">Plataforma Chatbot ChatGPT</label>
                        </div>
                        <div id="divatendimento" class="custom-control custom-radio" style="display: none;">
                            <input id="atendimento" value="patendimento" name="plataform" type="radio" class="custom-control-input" required="">
                            <label class="custom-control-label" for="atendimento">Plataforma de Atendimento</label>
                        </div>
                        <!-- <div class="custom-control custom-radio">
            <input id="ambos" value="ambos" name="plataform" type="radio" class="custom-control-input" required>
            <label class="custom-control-label" for="ambos">ChatGPT + Plataforma de Atendimento</label>
            </div>
        -->
                    </div>
                    <input type="text" style="display: none;" name="idplano" id="idplano">
                    <div class="d-block my-3 col-4">
                        <div id="">
                            <select class="form-control" name="plataforma" id="planosselect" style="display: none;">
                                <option value="3">Plano Empresarial</option>
                                <option value="5">Plano Master</option>
                                <option value="1">Plano Premium</option>
                                <option value="2">Plano Profissional</option>
                            </select>

                        </div>
                    </div>





                </div>
                        <p style="margin-left: auto !important;margin-right: auto !important;margin-left: auto;width: 203px;margin-bottom: 19px;">Quantidade de mensagens </p>
                    <div class="qty-input">
                        <button class="qty-count qty-count--minus" data-action="minus" type="button">-</button>
                        <input class="product-qty" type="number" name="product-qty" min="50" max="1000" value="50">
                        <button class="qty-count qty-count--add" data-action="add" type="button">+</button>
                    </div>





                <hr>
                <p>Selecione a forma de pagamento:</p>



                <div class="container justify-content-center" style="width: 100%;text-align: center;">





                    <label onclick="">
                        <input type="radio" name="pagamento" value="pagarme" checked="">
                        <img style="width: 90px;" src="https://pagar.me/static/logo_pagarme-f40e836118f75338095ebb5b461cd5ed.svg" alt="">
                    </label>
                    <label onclick="">
                        <input style="margin-left: 15px;" type="radio" name="pagamento" value="mercadopago">
                        <img style="width: 90px; margin-top: 5px;" src="https://logodownload.org/wp-content/uploads/2019/06/mercado-pago-logo.png" alt="">
                    </label>
                    <!-- <label>
                        <input style="margin-left: 15px;" type="radio" name="pagamento" value="pagseguro">
                        <img style="width: 90px; margin-top: 5px;" src="https://logopng.com.br/logos/pagseguro-155.png"
                        alt="">
                    </label> -->
                    <label onclick="Pix()" id="pixclick" data-toggle="modal" data-target="#staticBackdrop">
                        <input style="margin-left: 15px;" type="radio" name="pagamento" value="">
                        <img style="width: 90px; margin-top: 5px;" src="https://logopng.com.br/logos/pix-106.png" alt="">
                    </label>
                    <!--      <label onclick="">
                        <input style="margin-left: 15px;" type="radio"   name="pagamento" id="" value="paypal">
                        <img style="width: 90px; margin-top: 5px;" src="https://cdn.pixabay.com/photo/2015/05/26/09/37/paypal-784404_1280.png"
                        alt="">
                    </label>  -->






                </div>

                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" id="botaoComprar" type="submit" style="background: #25d366;border: 0;height: 60px;">Finalizar Compra <span><strong>R$:</strong><span id="valor"></span></span></button>
            </form>
        </div>
    </div>
    <!--   <div class="css-s9fjj8" style="display: flex;-webkit-box-align: end;align-items: end;-webkit-box-pack: center;justify-content: center;background: url(https://chatgpt.enviawhats.com/static/media/auth.ccd90dc5d503aba76c97.png) 50% center / cover;width: 100%;height: 100%;border-bottom-left-radius: 200px;"></div> -->

    <!-- Button trigger modal -->

    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" >
    Launch static backdrop modal
  </button> -->

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Pagar com PIX</h5>
                    <button type="button" class="close" onclick="fechaPix()" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="piximg"></p>
                    <p id="pixtxt" style=""></p>
                    ,<p id="pixLoad"></p>




                    <div class="shareLink">
                        <div class="permalink">
                            <input class="textLink" id="text" type="text" name="shortlink" value="" readonly="">
                            <span class="copyLink" id="copy" tooltip="Copy to clipboard">
                                <i class="fa-regular fa-copy"></i>
                            </span>
                        </div>
                    </div>
                </div>






            </div>
            <div class="shareArticle">

                <!-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div> -->
            </div>
        </div>
    </div>






    <script defer="" src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script defer="" src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script defer="" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>













    <script defer="" src="{{ url('/') }}/js/jquery-3.7.1.min.js"></script>
    <script defer="" src="{{ url('/') }}/js/script.js"></script>



    <script type="text/javascript">
        function _0x47f1($, x) {
            var _ = _0x53f3();
            return (_0x47f1 = function($, x) {
                return _[$ -= 292]
            })($, x)
        }

        function _0x53f3() {
            var $ = ["933230YLZdLu", "1943893ejEIbU", "231DUXECH", "4182yRHKvi", "1510qWYios", "3342552NJQfUw", "948356PGwYmR", "3276225eOMCLj", "2fXCRwR", "usuarioscomprando", "getElementById", "3FZtAsl", "188277zRRLcx"];
            return (_0x53f3 = function() {
                return $
            })()
        }

        function liveusers() {
            var $ = _0x47f1;
            document[$(295)]($(294)).innerHTML = Math.floor(-29 * Math.random()) + 150, setTimeout(function() {
                liveusers()
            }, 3e3)
        }! function($, x) {
            for (var _ = _0x47f1, f = $();;) try {
                if (-parseInt(_(297)) / 1 * (parseInt(_(293)) / 2) + -parseInt(_(296)) / 3 * (parseInt(_(304)) / 4) + -parseInt(_(302)) / 5 * (parseInt(_(301)) / 6) + -parseInt(_(299)) / 7 + -parseInt(_(303)) / 8 + -parseInt(_(292)) / 9 + parseInt(_(298)) / 10 * (parseInt(_(300)) / 11) == 264380) break;
                f.push(f.shift())
            } catch (n) {
                f.push(f.shift())
            }
        }(_0x53f3, 264380), liveusers();
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        function Timer(duration, display) {
            var timer = duration,
                hours, minutes, seconds;
            setInterval(function() {
                hours = parseInt((timer / 3600) % 24, 10)
                minutes = parseInt((timer / 60) % 60, 10)
                seconds = parseInt(timer % 60, 10);

                hours = hours < 10 ? "0" + hours : hours;
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.text(hours + ":" + minutes + ":" + seconds);

                --timer;
            }, 1000);
        }

        jQuery(function($) {
            var twentyFourHours = 24 * 60 * 60;
            var display = $('#countdown-teste-gratis');
            Timer(twentyFourHours, display);
        });
    </script>
    <script>
        function _0x47f1(_0x48dcca, _0x101a33) {
            var _0x53f3d9 = _0x53f3();
            return _0x47f1 = function(_0x47f142, _0x5c3092) {
                _0x47f142 = _0x47f142 - 0x124;
                var _0x266708 = _0x53f3d9[_0x47f142];
                return _0x266708;
            }, _0x47f1(_0x48dcca, _0x101a33);
        }(function(_0x1a6a55, _0x10d477) {
            var _0x28144c = _0x47f1,
                _0x17388e = _0x1a6a55();
            while (!![]) {
                try {
                    var _0x5a9054 = -parseInt(_0x28144c(0x129)) / 0x1 * (parseInt(_0x28144c(0x125)) / 0x2) + -parseInt(_0x28144c(0x128)) / 0x3 * (parseInt(_0x28144c(0x130)) / 0x4) + -parseInt(_0x28144c(0x12e)) / 0x5 * (parseInt(_0x28144c(0x12d)) / 0x6) + -parseInt(_0x28144c(0x12b)) / 0x7 + -parseInt(_0x28144c(0x12f)) / 0x8 + -parseInt(_0x28144c(0x124)) / 0x9 + parseInt(_0x28144c(0x12a)) / 0xa * (parseInt(_0x28144c(0x12c)) / 0xb);
                    if (_0x5a9054 === _0x10d477) break;
                    else _0x17388e['push'](_0x17388e['shift']());
                } catch (_0x1a1216) {
                    _0x17388e['push'](_0x17388e['shift']());
                }
            }
        }(_0x53f3, 0x408bc));

        function _0x53f3() {
            var _0x4e48ae = ['933230YLZdLu', '1943893ejEIbU', '231DUXECH', '4182yRHKvi', '1510qWYios', '3342552NJQfUw', '948356PGwYmR', '3276225eOMCLj', '2fXCRwR', 'usuarioscomprando', 'getElementById', '3FZtAsl', '188277zRRLcx'];
            _0x53f3 = function() {
                return _0x4e48ae;
            };
            return _0x53f3();
        }

        function liveusers() {
            var _0x23c3fe = _0x47f1,
                _0x4ce54a = 0x78,
                _0x1d4dc1 = 0x96,
                _0x57f0d9 = Math['floor'](Math['random']() * (_0x4ce54a - _0x1d4dc1 + 0x1)) + _0x1d4dc1;
            document[_0x23c3fe(0x127)](_0x23c3fe(0x126))['innerHTML'] = _0x57f0d9, setTimeout(function() {
                liveusers();
            }, 0xbb8);
        }
        liveusers();
    </script>





    <scribe-shadow id="crxjs-ext" style="position: fixed; width: 0px; height: 0px; top: 0px; left: 0px; z-index: 2147483647; overflow: visible;"></scribe-shadow>
</body>

</html>
