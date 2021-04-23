//Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 


window.addEventListener("load", principal);

function principal(){ 
    
    mais()
    toggleConvida()
    showPedidos()
    showCandidatar()
    showSeguir()
    showPubSeg()

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

    botao_pedidos.addEventListener("click", function(){
        if (botao_pedidos.innerText == "Ver Mais") {
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
        } else {
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
        showPedidos();
    })

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
        showPedidos();
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
        showPedidos();
    })
}

function showPedidos(){

    let botao_pedidos = document.getElementById("vermaisped")

    if (botao_pedidos.innerText == "Ver Mais") {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("Ped").innerHTML = this.responseText
            }
        }
        xmlhttp.open("GET", "../Controller/PedidosController.php?verpedidos=closed", true);
        xmlhttp.send();  
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("Ped").innerHTML = this.responseText
            }
        }
        xmlhttp.open("GET", "../Controller/PedidosController.php?verpedidos=open", true);
        xmlhttp.send();  
    }
}

function responderPed(resposta, tipo, id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showPedidos()
        }
    }
    xmlhttp.open("GET", "../Controller/PedidosController.php?responderped=yes&resposta="+resposta+"&tipo="+tipo+"&id="+id, true);
    xmlhttp.send();
}

function toggleConvida() {
    let botao_open = document.getElementById("openConvida")
    
    let div_convida = document.getElementById("convidaVol")

    if (botao_open != null) {
        botao_open.addEventListener("click", function(){
            div_convida.setAttribute("class", "visible")
            showConvida();
        })
    }
}

function closeConvida() {

    let botao_close = document.getElementById("closeConvida")
    let div_convida = document.getElementById("convidaVol")

    div_convida.setAttribute("class", "hidden")

}

function showConvida() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (document.getElementById("convidaVol") != null) {
                document.getElementById("convidaVol").innerHTML = this.responseText
                showPedidos()
            }
        }
    }
    xmlhttp.open("GET", "../Controller/PerfilController.php?show_div_convida=yes", true);
    xmlhttp.send();  
}

function convidaAcao(id_acao, id_vol) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showConvida()
        }
    }
    xmlhttp.open("GET", "../Controller/PerfilController.php?convida_acao=yes&id_acao_convida="+String(id_acao)+"&id_vol_convida="+String(id_vol), true);
    xmlhttp.send();  
}

function showCandidatar() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (document.getElementById("candidatarDiv") != null) {
                document.getElementById("candidatarDiv").innerHTML = this.responseText
                showPedidos()
            }
        }
    }
    xmlhttp.open("GET", "../Controller/PerfilController.php?show_div_candidata=yes", true);
    xmlhttp.send();  
}

function candidataAcao(id_vol, id_acao) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showCandidatar()
        }
    }
    xmlhttp.open("GET", "../Controller/PerfilController.php?candidata_acao=yes&id_acao_candidata="+String(id_acao)+"&id_vol_candidata="+String(id_vol), true);
    xmlhttp.send();
}

function showSeguir() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (document.getElementById("seguirDiv") != null) {
                document.getElementById("seguirDiv").innerHTML = this.responseText
                showPubSeg()
            }
        }
    }
    xmlhttp.open("GET", "../Controller/PerfilController.php?show_div_seguir=yes", true);
    xmlhttp.send(); 
}

function Seguir() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showSeguir();
        }
    }
    xmlhttp.open("GET", "../Controller/PerfilController.php?seguir_user=yes", true);
    xmlhttp.send(); 
}

function deixarSeguir() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showSeguir();
        }
    }
    xmlhttp.open("GET", "../Controller/PerfilController.php?deixar_seguir_user=yes", true);
    xmlhttp.send(); 
}

function showPubSeg() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (document.getElementById("divNPubSeg") != null) {
                document.getElementById("divNPubSeg").innerHTML = this.responseText
            }
        }
    }
    xmlhttp.open("GET", "../Controller/PerfilController.php?show_div_pubseg=yes", true);
    xmlhttp.send(); 
}