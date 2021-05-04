//Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 


window.addEventListener("load", principal);

function principal(){ 
    
    UpdateMessageDiv = 0
    toggleConvida()
    showPedidos()
    showCandidatar()
    showSeguir()
    showPubSeg()
    showSug()
    mais()
    showMsg()
    ConversaPrivada = []
    showPublicacoes()

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
        showSug();
        if (ConversaPrivada.length == 0) {
            showMsg()
        } else {
            showMensagens(ConversaPrivada[0], ConversaPrivada[1])
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
        showPedidos();
        showSug();
        if (ConversaPrivada.length == 0) {
            showMsg()
        } else {
            showMensagens(ConversaPrivada[0], ConversaPrivada[1])
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
            showPedidos();
            showSug();
            if (ConversaPrivada.length == 0) {
                showMsg()
            } else {
                showMensagens(ConversaPrivada[0], ConversaPrivada[1])
            }
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
            showPedidos();
            showSug();
            if (ConversaPrivada.length == 0) {
                showMsg()
            } else {
                showMensagens(ConversaPrivada[0], ConversaPrivada[1])
            }
        }
        
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
        xmlhttp.open("POST", "../Controller/PedidosController.php?verpedidos=closed", true);
        xmlhttp.send();  
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("Ped").innerHTML = this.responseText
            }
        }
        xmlhttp.open("POST", "../Controller/PedidosController.php?verpedidos=open", true);
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
    xmlhttp.open("POST", "../Controller/PedidosController.php?responderped=yes&resposta="+resposta+"&tipo="+tipo+"&id="+id, true);
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
    xmlhttp.open("POST", "../Controller/PerfilController.php?show_div_convida=yes", true);
    xmlhttp.send();  
}

function convidaAcao(id_acao, id_vol) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showConvida()
        }
    }
    xmlhttp.open("POST", "../Controller/PerfilController.php?convida_acao=yes&id_acao_convida="+String(id_acao)+"&id_vol_convida="+String(id_vol), true);
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
    xmlhttp.open("POST", "../Controller/PerfilController.php?show_div_candidata=yes", true);
    xmlhttp.send();  
}

function candidataAcao(id_vol, id_acao) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showCandidatar()
        }
    }
    xmlhttp.open("POST", "../Controller/PerfilController.php?candidata_acao=yes&id_acao_candidata="+String(id_acao)+"&id_vol_candidata="+String(id_vol), true);
    xmlhttp.send();
}

function showSeguir() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (document.getElementById("seguirDiv") != null) {
                document.getElementById("seguirDiv").innerHTML = this.responseText
            }
            showPubSeg()
            showSug()
        }
    }
    xmlhttp.open("POST", "../Controller/PerfilController.php?show_div_seguir=yes", true);
    xmlhttp.send(); 
}

function Seguir() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showSeguir();
        }
    }
    xmlhttp.open("POST", "../Controller/PerfilController.php?seguir_user=yes", true);
    xmlhttp.send(); 
}

function seguirSug(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showSeguir();
        }
    }
    xmlhttp.open("POST", "../Controller/PerfilController.php?seguir_sug="+String(id), true);
    xmlhttp.send(); 
}

function deixarSeguir() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showSeguir();
        }
    }
    xmlhttp.open("POST", "../Controller/PerfilController.php?deixar_seguir_user=yes", true);
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
    xmlhttp.open("POST", "../Controller/PerfilController.php?show_div_pubseg=yes", true);
    xmlhttp.send(); 
}

function showSug() {
    let botao_sugestoes = document.getElementById("vermaissug")

    if (botao_sugestoes.innerText == "Ver Mais") {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("Sug").innerHTML = this.responseText
            }
        }
        xmlhttp.open("POST", "../Controller/SugestoesController.php?versugestoes=closed", true);
        xmlhttp.send();  
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("Sug").innerHTML = this.responseText
            }
        }
        xmlhttp.open("POST", "../Controller/SugestoesController.php?versugestoes=open", true);
        xmlhttp.send();  
    }
}

function searchMessage(str) {
    var xhttp;
    if (str.length == 0) { 
      document.getElementById("searchMensagemDiv").innerHTML = "";
      return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("searchMensagemDiv").innerHTML = this.responseText;
        if (this.responseText == "") {
            document.getElementById("searchMensagemDiv").setAttribute("class", "w3-bar-item hidden")
        } else {
            document.getElementById("searchMensagemDiv").setAttribute("class", "w3-bar-item visible")
        }
      }
    };
    xhttp.open("POST", "../Controller/MensagemController.php?q="+str, true);
    xhttp.send(); 
}

function showMsg() {
    if (UpdateMessageDiv == 0) {
        UpdateMessageDiv = 1

        let botao_mensagens = document.getElementById("vermaismsg")
    
        if (botao_mensagens.innerText == "Ver Mais") {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    if (document.getElementById("searchDiv") == null) {
                        document.getElementById("Msg").innerHTML = ""
                        let divs = document.createElement("div")
                        divs.setAttribute("class", "w3-indigo w3-border-top w3-border-white")
                        divs.setAttribute("id", "searchDiv")
                        document.getElementById("Msg").appendChild(divs)
                        divs.innerHTML = "&nbsp&nbsp<i class='fas fa-search'></i>&nbsp&nbsp<input type='text' class='searchMessage' onkeyup='searchMessage(this.value)' placeholder='Procura...'><div id='searchMensagemDiv' class='w3-block hidden'></div>"
                    }

                    if (document.getElementById("showConversasDiv") != null) {
                        document.getElementById("showConversasDiv").remove()
                    }
                    let divc = document.createElement("div")
                    divc.setAttribute("id", "showConversasDiv")
                    document.getElementById("Msg").appendChild(divc)
                    divc.innerHTML = this.responseText
                    ConversaPrivada = []

                    let search_mensagens = document.getElementById("searchMensagemDiv")
                    if (search_mensagens.style.top != "38%") {
                        search_mensagens.style.top = "38%";
                    } 
                }
            }
            xmlhttp.open("POST", "../Controller/MensagemController.php?vermensagens=closed", true);
            xmlhttp.send();  
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let divsearch = document.getElementById("searchDiv")

                    if (divsearch == null) {
                        document.getElementById("Msg").innerHTML = ""
                        let divs = document.createElement("div")
                        divs.setAttribute("class", "w3-indigo w3-border-top w3-border-white")
                        divs.setAttribute("id", "searchDiv")
                        document.getElementById("Msg").appendChild(divs)
                        divs.innerHTML = "&nbsp&nbsp<i class='fas fa-search'></i>&nbsp&nbsp<input type='text' class='searchMessage' onkeyup='searchMessage(this.value)' placeholder='Procura...'><div id='searchMensagemDiv' class='w3-block hidden'></div>"
                    }

                    if (document.getElementById("showConversasDiv") != null) {
                        document.getElementById("showConversasDiv").remove()
                    }
                    let divc = document.createElement("div")
                    divc.setAttribute("id", "showConversasDiv")
                    document.getElementById("Msg").appendChild(divc)
                    divc.innerHTML = this.responseText
                    ConversaPrivada = []

                    let search_mensagens = document.getElementById("searchMensagemDiv")
                    if (search_mensagens.style.top != "19%") {
                        search_mensagens.style.top = "19%";
                    }
                }
            }
            xmlhttp.open("POST", "../Controller/MensagemController.php?vermensagens=open", true);
            xmlhttp.send();  
        }
        UpdateMessageDiv = 0
    }
}

function showConversa(id_own, id_other) {

    if (UpdateMessageDiv == 0) {
        UpdateMessageDiv = 2

        if (document.getElementById("showConversasDiv") != null) {
            document.getElementById("showConversasDiv").remove()
        }

        if (document.getElementById("searchDiv") != null) {
            document.getElementById("searchDiv").remove()
        }
    
        if (document.getElementById("conversaopen") == null) {
            document.getElementById("Msg").innerHTML = ""
            let divopen = document.createElement("div")
            divopen.setAttribute("class", "w3-container w3-border-top w3-border-bottom w3-hover")
            divopen.setAttribute("id", "conversaopen")
            document.getElementById("Msg").appendChild(divopen)
        }
        
        if (document.getElementById("headerconversa") == null) {
            let header = document.createElement("header")
            header.setAttribute("class", "w3-white w3-text-indigo")
            header.setAttribute("id", "headerconversa")
            document.getElementById("conversaopen").appendChild(header)

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    header.innerHTML = this.responseText
                }
            }
            xmlhttp.open("POST", "../Controller/MensagemController.php?verheader=yes&header_other="+id_other, true);
            xmlhttp.send();
        }

        if (document.getElementById("textes") == null) {
            let textes = document.createElement("div")
            textes.setAttribute("class", "textes")
            textes.setAttribute("id", "textes")
            document.getElementById("conversaopen").appendChild(textes)
        }

        showMensagens(id_own, id_other);
           
        if (document.getElementById("footerconversa") == null) {
            console.log("aqui")
            let footer = document.createElement("footer")
            document.getElementById("conversaopen").appendChild(footer)
            footer.setAttribute("id", "footerconversa")
            footer.innerHTML = "<input type='text' id='send_msg_input' placeholder='Escreva uma mensagem...'></input> <button class='w3-button w3-hover-none' id='sendMessageButton'> <i class='fas fa-paper-plane'></i> </button>"
        }

        if (document.getElementById("sendMessageButton") != null) {
            document.getElementById("sendMessageButton").addEventListener("click", function() {
                sendMessage(id_own, id_other)
            })
        } 
        UpdateMessageDiv = 0
    }

}

function showMensagens(id_own, id_other) {
    if (UpdateMessageDiv == 0 || UpdateMessageDiv == 2) {
        UpdateMessageDiv = 1
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                var elementB = document.getElementsByClassName("textes")[0];
                let current = 0
                if (elementB != null) {
                    current = elementB.scrollTop
                }
            
                document.getElementById("textes").innerHTML = this.responseText
            
            
                var element = document.getElementsByClassName("textes")[0];
                if (ConversaPrivada.length == 0) {
                    if (element != null) {
                        element.scrollTop = element.scrollHeight;
                    }
                } else {
                    if (element != null && current != null) {
                        element.scrollTop = current;
                    } else {
                        if (element != null) {
                            element.scrollTop = element.scrollHeight;
                        }
                    }
                }
                ConversaPrivada = [id_own, id_other]

                let conversa_open = document.getElementById("conversaopen")
                let botao_mensagens = document.getElementById("vermaismsg")

                if (botao_mensagens.innerText == "Ver Mais") {  
                    if (conversa_open.style.height != "60%") {
                        conversa_open.style.height = "60%";
                    }
                } else {
                    if (conversa_open.style.height != "80%") {
                        conversa_open.style.height = "80%";
                    }
                }  

            }
        }
        xmlhttp.open("POST", "../Controller/MensagemController.php?verconversa=yes&own="+id_own+"&other="+id_other, true);
        xmlhttp.send();
        UpdateMessageDiv = 0
    }
}

function sendMessage(id_own, id_other) {

    msgtext = document.getElementById('send_msg_input').value

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            ConversaPrivada = [id_own, id_other]
            showMensagens(id_own, id_other);
        }
    }
    xmlhttp.open("POST", "../Controller/MensagemController.php?sendmessage=yes&send_own="+id_own+"&send_other="+id_other+"&send_text="+msgtext, true);
    xmlhttp.send();

    document.getElementById('send_msg_input').value = ""
}

function backConversa() {
    ConversaPrivada = []
    showMsg();
}

function showPublicacoes() {
    if (document.getElementById("PubDiv") != null) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("PubDiv").innerHTML = this.responseText
            }
        }
        xmlhttp.open("POST", "../Controller/PublicacoesController.php?show_publicacoes_perfil=yes", true);
        xmlhttp.send(); 
    }
}
 
setInterval(function(){  
    showPedidos();
    showSug();

    if (ConversaPrivada.length == 0) {
        if (UpdateMessageDiv == 0) {
            showMsg()
        }
    } else {
        if (UpdateMessageDiv == 0) {
            showMensagens(ConversaPrivada[0], ConversaPrivada[1])
        }
    }
    
}, 2000)
