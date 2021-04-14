//Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 


window.addEventListener("load", principal);

function principal(){ 
    
    mais()
    toggleConvida()

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

function verMaisPed(pedidos, loggedid, loggedtype) {

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

                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        pedidos = JSON.parse(this.responseText)
                    }
                }
                xmlhttp.open("GET", "../Controller/PedidosController.php?logid="+String(loggedid)+"&logtype="+String(loggedtype), true);
                xmlhttp.send();  

                if (pedidos.length == 0) {
                    htmlresposta += "<h6 class='w3-center w3-small'><b>Não existem pedidos pendentes.</b></h6>";
                }

                for (let x = 0; x < pedidos.length; x++) {

                    htmlresposta += "<div id='pedido"+JSON.stringify(x)+"' class='pedido w3-container w3-border-top w3-border-bottom'>";
                    htmlresposta += "<img src='../"+pedidos[x]['foto_voluntario']+"' alt='Avatar' class='w3-left w3-circle'>";

                    if (pedidos[x]['tipologged'] == 'instituicao'){
                        if (pedidos[x]['tipo'] == 'candidatura'){
                            htmlresposta += "<p><b>"+pedidos[x]['nome_voluntario']+"</b> candidatou-se a <b>"+pedidos[x]['nome_acao']+"</b>.</p>";
                            if (pedidos[x]['estado'] == 'Pendente'){
                                htmlresposta += "<button id="+JSON.stringify('aca'+pedidos[x]['id_voluntario']+pedidos[x]['id_acao'])+" onclick='responderPed("+JSON.stringify('Aceitar')+", "+JSON.stringify('Candidatura')+", "+JSON.stringify(pedidos[x]['id_voluntario'])+", "+JSON.stringify(pedidos[x]['id_acao'])+", "+JSON.stringify(x)+")' class='aceitarped w3-button w3-green'><i class='fas fa-check'></i></button>";
                                htmlresposta += "<button id="+JSON.stringify('rca'+pedidos[x]['id_voluntario']+pedidos[x]['id_acao'])+" onclick='responderPed("+JSON.stringify('Rejeitar')+", "+JSON.stringify('Candidatura')+", "+JSON.stringify(pedidos[x]['id_voluntario'])+", "+JSON.stringify(pedidos[x]['id_acao'])+", "+JSON.stringify(x)+")' class='rejeitarped w3-button w3-red'><i class='fas fa-times'></i></button>";
                            } 
                            if (pedidos[x]['estado'] == 'Aceite') {
                                htmlresposta += "<p class='estadop w3-text-green'><b>"+pedidos[x]['estado']+"</b></p>";
                            } 
                            if (pedidos[x]['estado'] == 'Rejeitado') {
                                htmlresposta += "<p class='estadop w3-text-red'><b>"+pedidos[x]['estado']+"</b></p>";
                            }
                        } else {
                            htmlresposta += "<p><b>"+pedidos[x]['nome_acao']+"</b> convidou <b>"+pedidos[x]['nome_voluntario']+"</b>.</p>";
                            if (pedidos[x]['estado'] == 'Pendente'){
                                htmlresposta += "<p class='estadop w3-text-gray'><b>"+pedidos[x]['estado']+"</b></p>";
                            } 
                            if (pedidos[x]['estado'] == 'Aceite') {
                                htmlresposta += "<p class='estadop w3-text-green'><b>"+pedidos[x]['estado']+"</b></p>";
                            } 
                            if (pedidos[x]['estado'] == 'Rejeitado') {
                                htmlresposta += "<p class='estadop w3-text-red'><b>"+pedidos[x]['estado']+"</b></p>";
                            }
                        }
                    } else {
                        if (pedidos[x]['tipo'] == 'candidatura'){
                            htmlresposta += "<p><b>"+pedidos[x]['nome_voluntario']+"</b> candidatou-se a <b>"+pedidos[x]['nome_acao']+"</b>.</p>";
                            if (pedidos[x]['estado'] == 'Pendente'){
                                htmlresposta += "<p class='estadop w3-text-gray'><b>"+pedidos[x]['estado']+"</b></p>";
                            } 
                            if (pedidos[x]['estado'] == 'Aceite') {
                                htmlresposta += "<p class='estadop w3-text-green'><b>"+pedidos[x]['estado']+"</b></p>";
                            } 
                            if (pedidos[x]['estado'] == 'Rejeitado') {
                                htmlresposta += "<p class='estadop w3-text-red'><b>"+pedidos[x]['estado']+"</b></p>";
                            }
                        } else {
                            htmlresposta += "<p><b>"+pedidos[x]['nome_acao']+"</b> convidou <b>"+pedidos[x]['nome_voluntario']+"</b>.</p>";
                            if (pedidos[x]['estado'] == 'Pendente'){
                                htmlresposta += "<button id="+JSON.stringify('aco'+pedidos[x]['id_voluntario']+pedidos[x]['id_acao'])+" onclick='responderPed("+JSON.stringify('Aceitar')+", "+JSON.stringify('Convite')+", "+JSON.stringify(pedidos[x]['id_voluntario'])+", "+JSON.stringify(pedidos[x]['id_acao'])+", "+JSON.stringify(x)+")' class='aceitarped w3-button w3-green'><i class='fas fa-check'></i></button>";
                                htmlresposta += "<button id="+JSON.stringify('rco'+pedidos[x]['id_voluntario']+pedidos[x]['id_acao'])+" onclick='responderPed("+JSON.stringify('Rejeitar')+", "+JSON.stringify('Convite')+", "+JSON.stringify(pedidos[x]['id_voluntario'])+", "+JSON.stringify(pedidos[x]['id_acao'])+", "+JSON.stringify(x)+")' class='rejeitarped w3-button w3-red'><i class='fas fa-times'></i></button>";
                            } 
                            if (pedidos[x]['estado'] == 'Aceite') {
                                htmlresposta += "<p class='estadop w3-text-green'><b>"+pedidos[x]['estado']+"</b></p>";
                            } 
                            if (pedidos[x]['estado'] == 'Rejeitado') {
                                htmlresposta += "<p class='estadop w3-text-red'><b>"+pedidos[x]['estado']+"</b></p>";
                            }
                        }
                    }

                    htmlresposta += "</div>";
                }

                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        pedidos = JSON.parse(this.responseText)
                    }
                }
                xmlhttp.open("GET", "../Controller/PedidosController.php?logid="+String(loggedid)+"&logtype="+String(loggedtype), true);
                xmlhttp.send();  
                
                //htmlresposta += "</div>";
                htmlresposta += "<button type='button' onclick='verMaisPed("+JSON.stringify(pedidos)+", "+JSON.stringify(loggedid)+", "+JSON.stringify(loggedtype)+")' id='vermaisped' class='vermais w3-button w3-block w3-indigo w3-small w3-round'>Ver Menos</button>";
                htmlresposta += "</div>";

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

                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        pedidos = JSON.parse(this.responseText)
                    }
                }
                xmlhttp.open("GET", "../Controller/PedidosController.php?logid="+String(loggedid)+"&logtype="+String(loggedtype), true);
                xmlhttp.send();  

                if (pedidos.length == 0) {
                    htmlresposta += "<h6 class='w3-center w3-small'><b>Não existem pedidos pendentes.</b></h6>";
                }

                let max = 0;
                if (pedidos.length > 2) {
                    max = 2;
                } else {
                    max = pedidos.length;
                }

                for (let x = 0; x < max; x++) {

                    htmlresposta += "<div id='pedido"+JSON.stringify(x)+"' class='pedido w3-container w3-border-top w3-border-bottom'>";
                    htmlresposta += "<img src='../"+pedidos[x]['foto_voluntario']+"' alt='Avatar' class='w3-left w3-circle'>";
                    
                    if (pedidos[x]['tipologged'] == 'instituicao'){
                        if (pedidos[x]['tipo'] == 'candidatura'){
                            htmlresposta += "<p><b>"+pedidos[x]['nome_voluntario']+"</b> candidatou-se a <b>"+pedidos[x]['nome_acao']+"</b>.</p>";
                            if (pedidos[x]['estado'] == 'Pendente'){
                                htmlresposta += "<button id="+JSON.stringify('aca'+pedidos[x]['id_voluntario']+pedidos[x]['id_acao'])+" onclick='responderPed("+JSON.stringify('Aceitar')+", "+JSON.stringify('Candidatura')+", "+JSON.stringify(pedidos[x]['id_voluntario'])+", "+JSON.stringify(pedidos[x]['id_acao'])+", "+JSON.stringify(x)+")' class='aceitarped w3-button w3-green'><i class='fas fa-check'></i></button>";
                                htmlresposta += "<button id="+JSON.stringify('rca'+pedidos[x]['id_voluntario']+pedidos[x]['id_acao'])+" onclick='responderPed("+JSON.stringify('Rejeitar')+", "+JSON.stringify('Candidatura')+", "+JSON.stringify(pedidos[x]['id_voluntario'])+", "+JSON.stringify(pedidos[x]['id_acao'])+", "+JSON.stringify(x)+")' class='rejeitarped w3-button w3-red'><i class='fas fa-times'></i></button>";
                            } 
                            if (pedidos[x]['estado'] == 'Aceite') {
                                htmlresposta += "<p class='estadop w3-text-green'><b>"+pedidos[x]['estado']+"</b></p>";
                            } 
                            if (pedidos[x]['estado'] == 'Rejeitado') {
                                htmlresposta += "<p class='estadop w3-text-red'><b>"+pedidos[x]['estado']+"</b></p>";
                            }
                        } else {
                            htmlresposta += "<p><b>"+pedidos[x]['nome_acao']+"</b> convidou <b>"+pedidos[x]['nome_voluntario']+"</b>.</p>";
                            if (pedidos[x]['estado'] == 'Pendente'){
                                htmlresposta += "<p class='estadop w3-text-gray'><b>"+pedidos[x]['estado']+"</b></p>";
                            } 
                            if (pedidos[x]['estado'] == 'Aceite') {
                                htmlresposta += "<p class='estadop w3-text-green'><b>"+pedidos[x]['estado']+"</b></p>";
                            } 
                            if (pedidos[x]['estado'] == 'Rejeitado') {
                                htmlresposta += "<p class='estadop w3-text-red'><b>"+pedidos[x]['estado']+"</b></p>";
                            }
                        }
                    } else {
                        if (pedidos[x]['tipo'] == 'candidatura'){
                            htmlresposta += "<p><b>"+pedidos[x]['nome_voluntario']+"</b> candidatou-se a <b>"+pedidos[x]['nome_acao']+"</b>.</p>";
                            if (pedidos[x]['estado'] == 'Pendente'){
                                htmlresposta += "<p class='estadop w3-text-gray'><b>"+pedidos[x]['estado']+"</b></p>";
                            } 
                            if (pedidos[x]['estado'] == 'Aceite') {
                                htmlresposta += "<p class='estadop w3-text-green'><b>"+pedidos[x]['estado']+"</b></p>";
                            } 
                            if (pedidos[x]['estado'] == 'Rejeitado') {
                                htmlresposta += "<p class='estadop w3-text-red'><b>"+pedidos[x]['estado']+"</b></p>";
                            }
                        } else {
                            htmlresposta += "<p><b>"+pedidos[x]['nome_acao']+"</b> convidou <b>"+pedidos[x]['nome_voluntario']+"</b>.</p>";
                            if (pedidos[x]['estado'] == 'Pendente'){
                                htmlresposta += "<button id="+JSON.stringify('aco'+pedidos[x]['id_voluntario']+pedidos[x]['id_acao'])+" onclick='responderPed("+JSON.stringify('Aceitar')+", "+JSON.stringify('Convite')+", "+JSON.stringify(pedidos[x]['id_voluntario'])+", "+JSON.stringify(pedidos[x]['id_acao'])+", "+JSON.stringify(x)+")' class='aceitarped w3-button w3-green'><i class='fas fa-check'></i></button>";
                                htmlresposta += "<button id="+JSON.stringify('rco'+pedidos[x]['id_voluntario']+pedidos[x]['id_acao'])+" onclick='responderPed("+JSON.stringify('Rejeitar')+", "+JSON.stringify('Convite')+", "+JSON.stringify(pedidos[x]['id_voluntario'])+", "+JSON.stringify(pedidos[x]['id_acao'])+", "+JSON.stringify(x)+")' class='rejeitarped w3-button w3-red'><i class='fas fa-times'></i></button>";
                            } 
                            if (pedidos[x]['estado'] == 'Aceite') {
                                htmlresposta += "<p class='estadop w3-text-green'><b>"+pedidos[x]['estado']+"</b></p>";
                            } 
                            if (pedidos[x]['estado'] == 'Rejeitado') {
                                htmlresposta += "<p class='estadop w3-text-red'><b>"+pedidos[x]['estado']+"</b></p>";
                            }
                        }
                    }

                    htmlresposta += "</div>";
                }

                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        pedidos = JSON.parse(this.response)
                    }
                }
                xmlhttp.open("GET", "../Controller/PedidosController.php?logid="+String(loggedid)+"&logtype="+String(loggedtype), true);
                xmlhttp.send();  
                            
                //htmlresposta += "</div>";
                htmlresposta += "<button type='button' onclick='verMaisPed("+JSON.stringify(pedidos)+", "+JSON.stringify(loggedid)+", "+JSON.stringify(loggedtype)+")' id='vermaisped' class='vermais w3-button w3-block w3-indigo w3-small w3-round'>Ver Mais</button>";
                htmlresposta += "</div>";

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
        }
        xmlhttp.open("GET", "Perfil.php", true);
        xmlhttp.send();

    }
    
}

function toggleConvida() {
    let botao_open = document.getElementById("openConvida")
    let botao_close = document.getElementById("closeConvida")
    let div_convida = document.getElementById("convidaVol")

    if (botao_open != null) {
        botao_open.addEventListener("click", function(){
            div_convida.setAttribute("class", "visible")
        })
    
        botao_close.addEventListener("click", function(){
            div_convida.setAttribute("class", "hidden")
            location.reload();
        })
    }
    
}

function convidaAcao(id_acao, id_vol) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let lenres = this.responseText.length
            if (this.responseText.substring(lenres-3, lenres) == 'yes') {
                document.getElementById("ca"+id_acao).setAttribute("class", "w3-right w3-indigo w3-round-xxlarge w3-gray")
                document.getElementById("ca"+id_acao).disabled = true;
                document.getElementById("ca"+id_acao).innerText = "Convidado";
            }
        }
    }
    xmlhttp.open("GET", "../Controller/PerfilController.php?convida_acao=yes&id_acao_convida="+String(id_acao)+"&id_vol_convida="+String(id_vol), true);
    xmlhttp.send();  
}

function responderPed(resposta, tipo, id_vol, id_acao, numero) {

    let divid = document.getElementById("pedido"+numero)

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let lenres = this.responseText.length
            if (this.responseText.substring(lenres-3, lenres) == 'yes') {
                if (tipo == "Candidatura") {
                    let strida = 'aca'+id_vol+id_acao
                    let stridr = 'rca'+id_vol+id_acao
                    document.getElementById(strida).remove()
                    document.getElementById(stridr).remove()
                    let p = document.createElement('p')
                    if (resposta == "Aceitar") {
                        p.setAttribute("class", "estadop w3-text-green")
                        p.innerHTML = "<b>Aceite</b>"
                    } else {
                        p.setAttribute("class", "estadop w3-text-red")
                        p.innerHTML = "<b>Rejeitado</b>"
                    }
                    divid.appendChild(p)
                } else {
                    let strida = 'aco'+id_vol+id_acao
                    let stridr = 'rco'+id_vol+id_acao
                    document.getElementById(strida).remove()
                    document.getElementById(stridr).remove()
                    let p = document.createElement('p')
                    if (resposta == "Aceitar") {
                        p.setAttribute("class", "estadop w3-text-green")
                        p.innerHTML = "<b>Aceite</b>"
                    } else {
                        p.setAttribute("class", "estadop w3-text-red")
                        p.innerHTML = "<b>Rejeitado</b>"
                    }
                    
                    divid.appendChild(p)
                }
            }
        }
    }
    xmlhttp.open("GET", "../Controller/PedidosController.php?r_resposta="+String(resposta)+"&r_tipo="+String(tipo)+"&r_id_vol="+String(id_vol)+"&r_id_acao="+String(id_acao), true);
    xmlhttp.send();  
}