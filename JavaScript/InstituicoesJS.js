//Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 


window.addEventListener("load", principal);

function principal() {
    openfilter()
    showAcoes();
}

function openfilter(){
    document.getElementById('filterb').addEventListener("click", function(){
        let divf = document.getElementById('divFiltrar')
        let voldiv = document.getElementById('VolDiv')
        let filterb = document.getElementById('filterb')
        if (divf.getAttribute("class") == "w3-container w3-small hidden"){
            divf.setAttribute("class", "w3-container w3-small visible")
            voldiv.style.marginTop = "82%";
            filterb.innerHTML = "<i class='fas fa-filter'></i> &nbsp Filtrar &nbsp <i class='fas fa-angle-up'></i>";
        } else {
            divf.setAttribute("class", "w3-container w3-small hidden")
            voldiv.style.marginTop = "46%";
            filterb.innerHTML = "<i class='fas fa-filter'></i> &nbsp Filtrar &nbsp <i class='fas fa-angle-down'></i>";
        }
        
    })
}

function showAcoes() {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("VolDiv").innerHTML = this.responseText
        }
    }
    xmlhttp.open("GET", "../Controller/InstituicoesController.php?show_acoes='yes'", true);
    xmlhttp.send();
}

function showAcoesFilter() {

    let instituicao = document.getElementById("instituicao").value
    let titulo = document.getElementById("titulo").value
    let distrito = document.getElementById("distrito").value
    let concelho = document.getElementById("concelho").value
    let freguesia = document.getElementById("freguesia").value
    let area = document.getElementById("area-interesse").value
    let populacao = document.getElementById("populacao-alvo").value
    let funcao = document.getElementById("funcao").value
    let numvagas = document.getElementById("numvagas").value
    let dia = document.getElementById("disponibilidade-dia").value
    let hora = document.getElementById("disponibilidade-hora").value
    let duracao = document.getElementById("disponibilidade-duracao").value

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("VolDiv").innerHTML = this.responseText
        }
    }
    xmlhttp.open("GET", "../Controller/InstituicoesController.php?show_acoes_filter='yes'&instituicao="+instituicao+
    "&titulo="+titulo+"&distrito="+distrito+"&concelho="+concelho+"&freguesia="+freguesia+"&area="+area+
    "&populacao="+populacao+"&funcao="+funcao+"&numvagas="+numvagas+"&dia="+dia+"&hora="+hora+"&duracao="+duracao, true);
    xmlhttp.send();
}

function LimparProcura() {

    document.getElementById("instituicao").value = ""
    document.getElementById("titulo").value = ""
    document.getElementById("distrito").value = ""
    document.getElementById("concelho").value = ""
    document.getElementById("freguesia").value = ""
    document.getElementById("area-interesse").value = ""
    document.getElementById("populacao-alvo").value = ""
    document.getElementById("funcao").value = ""
    document.getElementById("numvagas").value = ""
    document.getElementById("disponibilidade-dia").value = ""
    document.getElementById("disponibilidade-hora").value = ""
    document.getElementById("disponibilidade-duracao").value = ""

    showAcoes();

}
