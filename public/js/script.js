window.addEventListener("load", function () {
    // Código a ser executado após o carregamento completo da página
    console.log("Página carregada completamente");
    saveCache();
});
document
    .getElementById("formulariodeenvio")
    .addEventListener("submit", respostaCPF);

function respostaCPF(e) {
    if (!TestaCPF()) {
        e.preventDefault();
        createAlert(
            "",
            "Atenção!",
            "Digite um CPF correto!",
            "warning",
            true,
            true,
            "pageMessages"
        );
    }
}

function Pix() {
    document.getElementById("botaoComprar").style.display = "none";
    const nome = document.querySelector("input[name='nome']").value;
    var cpf = document.querySelector("input[name='cpf']").value;
    cpf = cpf.replace(/[.-]/g, "");
    const email = document.querySelector("input[name='email']").value;
    const ddd = document.querySelector("input[name='ddd']").value;
    var numero = document.querySelector("input[name='numero']").value;
    numero = numero.replace(/[.-]/g, "");
    //const estado = document.querySelector("input[name='nome']").value
    var estado = document.querySelector("#estado");
    var estado = estado.options[estado.selectedIndex].value;
    const cidade = document.querySelector("input[name='cidade']").value;
    const rua = document.querySelector("input[name='rua']").value;
    const cep = document.querySelector("input[name='cep']").value;
    const valor = "111";

    if (TestaCPF()) {
        $.ajax({
            url: "/api/pagamentoPix",
            type: "post",
            data: {
                nome: nome,
                cpf: cpf,
                numero: numero,
                ddd: ddd,
                estado: estado,
                cidade: cidade,
                rua: rua,
                email: email,
                pagamento: "pix",
                idplano: valor,
                plataform: "patendimento",
            },
            beforeSend: function () {
                $("#loadPix").html("Aguarde...");
            },
        })
            .done(function (msg) {
                console.log(JSON.parse(msg));
                msg = JSON.parse(msg);
                //localStorage.setItem("orderpix", msg.id);
                console.log(msg[0]);
                var imagemElement = $("<img>").attr("src", msg[0].url);
                imagemElement.addClass("col-12");
                var botao = document.getElementById("text");
                botao.style.display = "inline";
                document.getElementById("text").value = msg[0].code;
                var ordem = msg[0].ordem;
                localStorage.setItem("ordem", ordem);
                // Substitua o conteúdo da div com o elemento <img>
                $("#piximg").html(imagemElement);
                console.log(ordem);
                //document.querySelector("#qrgerado").innerText=""
            })
            .fail(function (jqXHR, textStatus, msg) {
                alert(msg);
            });
    } else {
        $("#pixtxt").html("Por favor, verifique se informou o CPF correto...");
    }
}

function fechaPix() {
    document.getElementById("botaoComprar").style.display = "block";
}

document.querySelectorAll(".dropdown-menu .dropdown-item").forEach((item) => {
    item.addEventListener("click", function (e) {
        e.preventDefault(); // Prevenir ação padrão do link, se necessário
        // console.log('Item selecionado:',  this.getAttribute('data-value'));
        // Execute sua ação aqui

        fetch("https://api.dev.enviawhats.com/plans/all").then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            // return response.json(); // Converte a resposta para JSON
            response.json().then((data) => {
                data.forEach((item) => {
                    // console.log(item.id);
                    if (item.id == this.getAttribute("data-value")) {
                        document.getElementById("qtdDispositivos").innerText =
                            item.connections;
                        document.getElementById("planname").innerText =
                            item.name;
                        document.getElementById("qtdFilas").innerText =
                            item.queues;
                        document.getElementById("qtdUsers").innerText =
                            item.users;
                        document.getElementById("gptBot").innerText =
                            item.gpt_messages_counter;
                        document.getElementById("idplano").value = item.id;
                        document.getElementById(
                            "valor"
                        ).innerText = `${item.value},00`;
                    }
                });
            });
        });
    });
});

//salva dados em cache
function saveCache() {
    //document.getElementById("botaoComprar").style.display="none"
    const nome = document.querySelector("input[name='nome']").value;
    var cpf = document.querySelector("input[name='cpf']").value;
    cpf = cpf.replace(/[.-]/g, "");
    const email = document.querySelector("input[name='email']").value;
    const ddd = document.querySelector("input[name='ddd']").value;
    var numero = document.querySelector("input[name='numero']").value;
    numero = numero.replace(/[.-]/g, "");
    //const estado = document.querySelector("input[name='nome']").value
    var estado = document.querySelector("#estado");
    var estado = estado.options[estado.selectedIndex].value;
    const cidade = document.querySelector("input[name='cidade']").value;
    const rua = document.querySelector("input[name='rua']").value;
    const cep = document.querySelector("input[name='cep']").value;
    //const valor = "111";
    //var localCpf = localStorage.getItem(cpf)
    if (localStorage.getItem("cpf").length > 1) {
        console.log("Ok");
        var localCpf = localStorage.getItem("cpf");
        var localNome = localStorage.getItem("nome");
        var localDdd = localStorage.getItem("ddd");
        var localNumero = localStorage.getItem("numero");
        var localEstado = localStorage.getItem("estado");
        var localCidade = localStorage.getItem("cidade");
        var localEndereco = localStorage.getItem("rua");
        var localCep = localStorage.getItem("cep");

        document.getElementById("cpf").value = localCpf;
        document.getElementById("primeiroNome").value = localNome;
        document.getElementById("ddd").value = localDdd;
        document.getElementById("numero").value = localNumero;
        document.getElementById("estado").value = localEstado;
        document.getElementById("cidade").value = localCidade;
        document.getElementById("endereco2").value = localEndereco;
        document.getElementById("cep").value = localCep;
    }
    if (!localStorage.getItem("cpf")) {
        localStorage.setItem("cpf", cpf);
        localStorage.setItem("nome", nome);
        localStorage.setItem("email", email);
        localStorage.setItem("ddd", ddd);
        localStorage.setItem("numero", numero);
        localStorage.setItem("estado", estado);
        localStorage.setItem("rua", rua);
        localStorage.setItem("cidade", cidade);
        localStorage.setItem("cep", cep);
        localStorage.setItem("rua", rua);
    }
}

//checkoutGPT
var QtyInput = (function () {
    var $qtyInputs = $(".qty-input");

    if (!$qtyInputs.length) {
        return;
    }

    var $inputs = $qtyInputs.find(".product-qty");
    var $countBtn = $qtyInputs.find(".qty-count");
    var qtyMin = parseInt($inputs.attr("min"));
    var qtyMax = parseInt($inputs.attr("max"));

    $inputs.change(function () {
        var $this = $(this);
        var $minusBtn = $this.siblings(".qty-count--minus");
        var $addBtn = $this.siblings(".qty-count--add");
        var qty = parseInt($this.val());

        if (isNaN(qty) || qty <= qtyMin) {
            $this.val(qtyMin);
            $minusBtn.attr("disabled", true);
        } else {
            $minusBtn.attr("disabled", false);

            if (qty >= qtyMax) {
                $this.val(qtyMax);
                $addBtn.attr("disabled", true);
            } else {
                $this.val(qty);
                $addBtn.attr("disabled", false);
            }
        }
    });

    $countBtn.click(function () {
        var operator = this.dataset.action;
        var $this = $(this);
        var $input = $this.siblings(".product-qty");
        var qty = parseInt($input.val());

        if (operator == "add") {
            qty += 50;
            if (qty >= qtyMin + 50) {
                $this.siblings(".qty-count--minus").attr("disabled", false);
            }

            if (qty >= qtyMax) {
                $this.attr("disabled", true);
            }
        } else {
            qty = qty <= qtyMin ? qtyMin : (qty -= 50);

            if (qty == qtyMin) {
                $this.attr("disabled", true);
            }

            if (qty < qtyMax) {
                $this.siblings(".qty-count--add").attr("disabled", false);
            }
        }

        $input.val(qty);
    });
})();

//validar cpf
function TestaCPF() {
    const campoCPF = document.getElementById("cpf");
    const strCPF = campoCPF.value; // Obter o valor do input
    let Soma;
    let Resto;
    Soma = 0;
    if (strCPF == "00000000000") return false;

    for (let i = 1; i <= 9; i++)
        Soma += parseInt(strCPF.substring(i - 1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;

    if (Resto == 10 || Resto == 11) Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10))) return false;

    Soma = 0;
    for (let i = 1; i <= 10; i++)
        Soma += parseInt(strCPF.substring(i - 1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if (Resto == 10 || Resto == 11) Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11))) return false;
    return true;
}

//alertas

function createAlert(
    title,
    summary,
    details,
    severity,
    dismissible,
    autoDismiss,
    appendToId
) {
    var iconMap = {
        info: "fa fa-info-circle",
        success: "fa fa-thumbs-up",
        warning: "fa fa-exclamation-triangle",
        danger: "fa ffa fa-exclamation-circle",
    };

    var iconAdded = false;

    var alertClasses = ["alert", "animated", "flipInX"];
    alertClasses.push("alert-" + severity.toLowerCase());

    if (dismissible) {
        alertClasses.push("alert-dismissible");
    }

    var msgIcon = $("<i />", {
        class: iconMap[severity], // you need to quote "class" since it's a reserved keyword
    });

    var msg = $("<div />", {
        class: alertClasses.join(" "), // you need to quote "class" since it's a reserved keyword
    });

    if (title) {
        var msgTitle = $("<h4 />", {
            html: title,
        }).appendTo(msg);

        if (!iconAdded) {
            msgTitle.prepend(msgIcon);
            iconAdded = true;
        }
    }

    if (summary) {
        var msgSummary = $("<strong />", {
            html: summary,
        }).appendTo(msg);

        if (!iconAdded) {
            msgSummary.prepend(msgIcon);
            iconAdded = true;
        }
    }

    if (details) {
        var msgDetails = $("<p />", {
            html: details,
        }).appendTo(msg);

        if (!iconAdded) {
            msgDetails.prepend(msgIcon);
            iconAdded = true;
        }
    }

    if (dismissible) {
        var msgClose = $("<span />", {
            class: "close", // you need to quote "class" since it's a reserved keyword
            "data-dismiss": "alert",
            html: "<i class='fa fa-times-circle'></i>",
        }).appendTo(msg);
    }

    $("#" + appendToId).prepend(msg);

    if (autoDismiss) {
        setTimeout(function () {
            msg.addClass("flipOutX");
            setTimeout(function () {
                msg.remove();
            }, 1000);
        }, 5000);
    }
}

//copia com um click pix

const input = document.getElementById("text");
const copyButton = document.getElementById("copy");

const copyText = (e) => {
    // window.getSelection().selectAllChildren(textElement);
    input.select(); //select input value
    document.execCommand("copy");
    e.currentTarget.setAttribute("tooltip", "Copied!");
    e.currentTarget.innerText = "copiado";
};

const resetTooltip = (e) => {
    e.currentTarget.setAttribute("tooltip", "Copy to clipboard");
};

copyButton.addEventListener("click", (e) => copyText(e));
copyButton.addEventListener("mouseover", (e) => resetTooltip(e));

input.addEventListener("click", (e) => copyText(e));
input.addEventListener("mouseover", (e) => resetTooltip(e));

function ocultarsubmit(opc) {
    var botao = document.getElementsByClassName("btn-primary")[0];
    botao.style.display = opc;
}

//verifica se pix foi pago
async function verificarPix(ordem) {
   const result = await fetch(`/api/pixstatus/${ordem}`)
        .then((response) => {
            if (!response.ok) {
                throw new Error("Falha na requisição");
            }
            // document.getElementById("pixstatus").innerText=response
            //console.log(response[0])
            return response.json(); // ou .text() se for esperado um texto plano
        })
        .then((data) => {
            console.log(data[0].status); // Processa os dados recebidos
           // document.getElementById("pixstatus").innerText = data[0].status;

            return data[0].status
        })
        .catch((error) => {
            console.error("Erro na requisição:", error);
        });
    return result
}

 setInterval( async() => {
       const result = await  verificarPix(localStorage.getItem("ordem"));
    console.log(result)
     if (result ==="paid"){
        document.getElementById("piximg").style.display="none"
        document.getElementById("sharelink").style.display="none"
        document.getElementById("pixSucesso").style.display="block"
        document.getElementById("pixstatustext").style.display="block"



}
}, 5000);
