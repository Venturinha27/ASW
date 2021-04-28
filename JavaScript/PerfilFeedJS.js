//Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 


window.addEventListener("load", principal);

function principal() {
    openfilter();
    showCandidatos();
    showCorrespondentes();
}

function openfilter(){
    document.getElementById('filterb').addEventListener("click", function(){
        let divf = document.getElementById('divFiltrar')
        let voldiv = document.getElementById('VolDiv')
        let filterb = document.getElementById('filterb')
        if (divf.getAttribute("class") == "w3-container w3-small hidden"){
            divf.setAttribute("class", "w3-container w3-small visible")
            filterb.innerHTML = "<i class='fas fa-filter'></i> &nbsp Filtrar &nbsp <i class='fas fa-angle-up'></i>";
        } else {
            divf.setAttribute("class", "w3-container w3-small hidden")
            filterb.innerHTML = "<i class='fas fa-filter'></i> &nbsp Filtrar &nbsp <i class='fas fa-angle-down'></i>";
        }
        
    })
}

function procuraCandidaturas() {
    let nome = document.getElementById("nome").value
    let idade = document.getElementById("idade").value
    let distrito = document.getElementById("distrito").value
    let concelho = document.getElementById("concelho").value
    let freguesia = document.getElementById("freguesia").value
    let genero = document.getElementById("genero").value
    let email = document.getElementById("email").value
    let carta = document.getElementById("carta").value
    let covid = document.getElementById("covid").value
    let area_interesse = document.getElementById("area-interesse").value
    let populacao_alvo = document.getElementById("populacao-alvo").value
    let dia = document.getElementById("dia").value
    let hora = document.getElementById("hora").value
    let duracao = document.getElementById("duracao").value

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("resultCandidaturas").innerHTML = this.responseText
        }
    }
    xmlhttp.open("POST", "../Controller/PerfilFeedController.php?procuracandidaturas=yes&nome="+nome+"&idade="+idade+
    "&distrito="+distrito+"&concelho="+concelho+"&freguesia="+freguesia+"&genero="+genero+"&email="+email+"&carta="+carta+"&covid="+covid+
    "&area_interesse="+area_interesse+"&populacao_alvo="+populacao_alvo+"&dia="+dia+"&hora="+hora+"&duracao="+duracao, true);
    xmlhttp.send();
}

function showCandidatos() {
    if (document.getElementById("resultCandidaturas") != null) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("resultCandidaturas").innerHTML = this.responseText
            }
        }
        xmlhttp.open("POST", "../Controller/PerfilFeedController.php?procuracandidaturas=no", true);
        xmlhttp.send();
    }
}

function showCorrespondentes() {
    if (document.getElementById("resultCorrespondentes") != null) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("resultCorrespondentes").innerHTML = this.responseText
            }
        }
        xmlhttp.open("POST", "../Controller/PerfilFeedController.php?procuracorrespondentes=yes", true);
        xmlhttp.send();
    }
}

function aceitarCand(id_candidato) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            procuraCandidaturas()
        }
    }
    xmlhttp.open("POST", "../Controller/PerfilFeedController.php?aceitarCand="+id_candidato, true);
    xmlhttp.send();
}

function rejeitarCand(id_candidato) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            procuraCandidaturas()
        }
    }
    xmlhttp.open("POST", "../Controller/PerfilFeedController.php?rejeitarCand="+id_candidato, true);
    xmlhttp.send();
}
