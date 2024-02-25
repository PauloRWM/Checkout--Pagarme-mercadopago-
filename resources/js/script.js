function Pix() {
   // alert("Botão clicado!");
    $.ajax({
        url: "pagamento",
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
            plataform: plataform,
        },
        beforeSend: function () {
            $("#teste").html("Aguarde...");
        },
    })
        .done(function (msg) {
            console.log(JSON.parse(msg));
            msg = JSON.parse(msg);
            localStorage.setItem("orderpix", msg.id);
            console.log(msg);
            var imagemElement = $("<img>").attr(
                "src",
                msg.charges[0].last_transaction.qr_code_url
            );
            imagemElement.addClass("col-12");
            var botao = document.getElementById("text");
            botao.style.display = "inline";
            document.getElementById("text").value =
                msg.charges[0].last_transaction.qr_code;

            // Substitua o conteúdo da div com o elemento <img>
            $("#piximg").html(imagemElement);

            //document.querySelector("#qrgerado").innerText=""
        })
        .fail(function (jqXHR, textStatus, msg) {
            alert(msg);
        });
}


