//Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 


window.addEventListener("load", principal);

function principal(){ 
    
    showAcoes("asc", "instituicao")

}

function showAcoes(order, variable) {

    let instituicao = document.getElementById("instituicao").value
    let titulo = document.getElementById("titulo").value
    let distrito = document.getElementById("distrito").value
    let concelho = document.getElementById("concelho").value
    let freguesia = document.getElementById("freguesia").value
    let area = document.getElementById("area-interesse").value
    let populacao = document.getElementById("populacao-alvo").value
    let funcao = document.getElementById("funcao").value
    let numvagas = document.getElementById("numvagas").value
    let data = document.getElementById("data").value
    let ativa = document.getElementById("ativa").value

    let divacoes = document.getElementById('resultadosAcoes')
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            divacoes.innerHTML = this.responseText
        }
    }
    xmlhttp.open("GET", "../Controller/AdminAController.php?show_acoes=yes&instituicao="+instituicao+
    "&titulo="+titulo+"&distrito="+distrito+"&concelho="+concelho+"&freguesia="+freguesia+"&area="+area+
    "&populacao="+populacao+"&funcao="+funcao+"&numvagas="+numvagas+"&data="+data+"&ativa="+ativa+
    "&order="+order+"&variable="+variable, true);
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
    document.getElementById("data").value = ""
    document.getElementById("ativa").value = ""

    showAcoes("asc", "instituicao");

}