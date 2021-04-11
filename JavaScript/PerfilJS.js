//Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 


window.addEventListener("load", principal);

function principal(){ 
    
    maisPedidos()

}

function maisPedidos(){
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