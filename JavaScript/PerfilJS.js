//Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 


window.addEventListener("load", principal);

function principal(){ 
    
    mais()

}

function mais(){
    let botao_pedidos = document.getElementById("vermaisped")
    let div_pedidos = document.getElementById("PedDiv")
    let botao_sugestoes = document.getElementById("vermaissug")
    let div_sugestoes = document.getElementById("SugDiv")
    let botao_mensagens = document.getElementById("vermaismsg")
    let div_mensagens = document.getElementById("MsgDiv")

    let ped_over = document.getElementById("Ped")
    let sug_over = document.getElementById("Sug") 
    let msg_over = document.getElementById("Msg")

    botao_sugestoes.addEventListener("click", function(){
        if (botao_sugestoes.innerText == "Ver Mais") {
            div_pedidos.style.height = "29%";
            div_mensagens.style.top = "41%";
            div_mensagens.style.height = "29%";
            div_sugestoes.style.top = "72%";
            div_sugestoes.style.height = "58%";
            botao_sugestoes.innerText = "Ver Menos";
            botao_mensagens.innerText = "Ver Mais";
            botao_pedidos.innerText = "Ver Mais";
            ped_over.style.overflowY = "unset";
            sug_over.style.overflowY = "scroll";
            msg_over.style.overflowY = "unset";
        } else {
            div_pedidos.style.height = "29%";
            div_mensagens.style.top = "41%";
            div_mensagens.style.height = "29%";
            div_sugestoes.style.top = "72%";
            div_sugestoes.style.height = "29%";
            botao_sugestoes.innerText = "Ver Mais";
            botao_mensagens.innerText = "Ver Mais";
            botao_pedidos.innerText = "Ver Mais";
            ped_over.style.overflowY = "unset";
            sug_over.style.overflowY = "unset";
            msg_over.style.overflowY = "unset";
        }
    })

    botao_mensagens.addEventListener("click", function(){
        if (botao_mensagens.innerText == "Ver Mais") {
            div_pedidos.style.height = "29%";
            div_mensagens.style.top = "41%";
            div_mensagens.style.height = "58%";
            div_sugestoes.style.top = "102%";
            div_sugestoes.style.height = "29%";
            botao_mensagens.innerText = "Ver Menos";
            botao_pedidos.innerText = "Ver Mais";
            botao_sugestoes.innerText = "Ver Mais";
            ped_over.style.overflowY = "unset";
            sug_over.style.overflowY = "unset";
            msg_over.style.overflowY = "scroll";
        } else {
            div_pedidos.style.height = "29%";
            div_mensagens.style.top = "41%";
            div_mensagens.style.height = "29%";
            div_sugestoes.style.top = "72%";
            div_sugestoes.style.height = "29%";
            botao_mensagens.innerText = "Ver Mais";
            botao_pedidos.innerText = "Ver Mais";
            botao_sugestoes.innerText = "Ver Mais";
            ped_over.style.overflowY = "unset";
            sug_over.style.overflowY = "unset";
            msg_over.style.overflowY = "unset";
        }
    })
}

function verMaisPed(pedidos) {

    let botao_pedidos = document.getElementById("vermaisped")
    let div_pedidos = document.getElementById("PedDiv")
    let botao_sugestoes = document.getElementById("vermaissug")
    let div_sugestoes = document.getElementById("SugDiv")
    let botao_mensagens = document.getElementById("vermaismsg")
    let div_mensagens = document.getElementById("MsgDiv")

    let ped_over = document.getElementById("Ped")
    let sug_over = document.getElementById("Sug") 
    let msg_over = document.getElementById("Msg")

    if (botao_pedidos.innerText == "Ver Mais") {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let htmlresposta = "";

                if (pedidos.length == 0) {
                    htmlresposta += "<h6 class='w3-center w3-small'><b>Não existem pedidos pendentes.</b></h6>";
                }

                for (let x = 0; x < pedidos.length; x++) {

                    htmlresposta += "<div class='pedido w3-container w3-border-top w3-border-bottom'>";
                    htmlresposta += "<img src='../"+pedidos[x]['foto_voluntario']+"' alt='Avatar' class='w3-left w3-circle'>";
                    htmlresposta += "<p><b>"+pedidos[x]['nome_voluntario']+"</b> candidatou-se a <b>"+pedidos[x]['nome_acao']+"</b>.</p>";
                    if (pedidos[x]['estado'] == 'Pendente'){
                        htmlresposta += "<button class='aceitarped w3-button w3-green'><i class='fas fa-check'></i></button>";
                        htmlresposta += "<button class='rejeitarped w3-button w3-red'><i class='fas fa-times'></i></button>";
                    } 
                    if (pedidos[x]['estado'] == 'Aceite') {
                        htmlresposta += "<p class='estadop w3-text-green'><b>"+pedidos[x]['estado']+"</b></p>";
                    } 
                    if (pedidos[x]['estado'] == 'Rejeitado') {
                        htmlresposta += "<p class='estadop w3-text-red'><b>"+pedidos[x]['estado']+"</b></p>";
                    }
                    htmlresposta += "</div>";
                }
                            
                htmlresposta += "<button type='button' onclick='verMaisPed("+JSON.stringify(pedidos)+")' id='vermaisped' class='vermais w3-button w3-block w3-indigo w3-small w3-round'>Ver Menos</button>";
                htmlresposta += "</div> </div>";;

                document.getElementById("Ped").innerHTML = htmlresposta;

                div_pedidos.style.height = "58%";
                div_mensagens.style.top = "71%";
                div_mensagens.style.height = "29%";
                div_sugestoes.style.top = "104%";
                div_sugestoes.style.height = "29%";
                botao_pedidos.innerText = "Ver Menos";
                botao_mensagens.innerText = "Ver Mais";
                botao_sugestoes.innerText = "Ver Mais";
                ped_over.style.overflowY = "scroll";
                sug_over.style.overflowY = "unset";
                msg_over.style.overflowY = "unset";
            }
        };
        xmlhttp.open("GET", "Perfil.php", true);
        xmlhttp.send();

    } else {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let htmlresposta = "";

                if (pedidos.length == 0) {
                    htmlresposta += "<h6 class='w3-center w3-small'><b>Não existem pedidos pendentes.</b></h6>";
                }

                for (let x = 0; x <= 1; x++) {

                    htmlresposta += "<div class='pedido w3-container w3-border-top w3-border-bottom'>";
                    htmlresposta += "<img src='../"+pedidos[x]['foto_voluntario']+"' alt='Avatar' class='w3-left w3-circle'>";
                    htmlresposta += "<p><b>"+pedidos[x]['nome_voluntario']+"</b> candidatou-se a <b>"+pedidos[x]['nome_acao']+"</b>.</p>";
                    if (pedidos[x]['estado'] == 'Pendente'){
                        htmlresposta += "<button class='aceitarped w3-button w3-green'><i class='fas fa-check'></i></button>";
                        htmlresposta += "<button class='rejeitarped w3-button w3-red'><i class='fas fa-times'></i></button>";
                    } 
                    if (pedidos[x]['estado'] == 'Aceite') {
                        htmlresposta += "<p class='estadop w3-text-green'><b>"+pedidos[x]['estado']+"</b></p>";
                    } 
                    if (pedidos[x]['estado'] == 'Rejeitado') {
                        htmlresposta += "<p class='estadop w3-text-red'><b>"+pedidos[x]['estado']+"</b></p>";
                    }
                    htmlresposta += "</div>";
                }
                            
                htmlresposta += "<button type='button' onclick='verMaisPed("+JSON.stringify(pedidos)+")' id='vermaisped' class='vermais w3-button w3-block w3-indigo w3-small w3-round'>Ver Mais</button>";
                htmlresposta += "</div> </div>";;

                document.getElementById("Ped").innerHTML = htmlresposta;

                div_pedidos.style.height = "29%";
                div_mensagens.style.top = "41%";
                div_mensagens.style.height = "29%";
                div_sugestoes.style.top = "72%";
                div_sugestoes.style.height = "29%";
                botao_pedidos.innerText = "Ver Mais";
                botao_mensagens.innerText = "Ver Mais";
                botao_sugestoes.innerText = "Ver Mais";
                ped_over.style.overflowY = "unset";
                sug_over.style.overflowY = "unset";
                msg_over.style.overflowY = "unset";
            }
        };
        xmlhttp.open("GET", "Perfil.php", true);
        xmlhttp.send();

    }
    
}