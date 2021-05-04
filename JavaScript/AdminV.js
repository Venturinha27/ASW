//Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 


window.addEventListener("load", principal);

function principal(){ 
    
    showVoluntarios("asc", "nome")

}

function showVoluntarios(order, variable) {

    let nome = document.getElementById("nome").value
    let idade = document.getElementById("idade").value
    let distrito = document.getElementById("distrito").value
    let concelho = document.getElementById("concelho").value
    let freguesia = document.getElementById("freguesia").value
    let genero = document.getElementById("genero").value
    let email = document.getElementById("email").value
    let carta = document.getElementById("carta").value
    let covid = document.getElementById("covid").value
    let area = document.getElementById("area-interesse").value
    let populacao = document.getElementById("populacao-alvo").value
    let dia = document.getElementById("dia").value
    let hora = document.getElementById("hora").value
    let duracao = document.getElementById("duracao").value

    let divvol = document.getElementById('resultadoVoluntarios')
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            divvol.innerHTML = this.responseText
        }
    }
    xmlhttp.open("POST", "../Controller/AdminVController.php?show_voluntarios=yes&nome="+nome+
    "&idade="+idade+"&distrito="+distrito+"&concelho="+concelho+"&freguesia="+freguesia+"&genero="+genero+
    "&email="+email+"&carta="+carta+"&covid="+covid+"&area="+area+"&populacao="+populacao+"&dia="+dia+
    "&hora="+hora+"&duracao="+duracao+"&order="+order+"&variable="+variable, true);
    xmlhttp.send();


}

function LimparProcura() {

    document.getElementById("nome").value = ""
    document.getElementById("idade").value = ""
    document.getElementById("distrito").value = ""
    document.getElementById("concelho").value = ""
    document.getElementById("freguesia").value = ""
    document.getElementById("genero").value = ""
    document.getElementById("email").value = ""
    document.getElementById("carta").value = ""
    document.getElementById("covid").value = ""
    document.getElementById("area-interesse").value = ""
    document.getElementById("populacao-alvo").value = ""
    document.getElementById("dia").value = ""
    document.getElementById("hora").value = ""
    document.getElementById("duracao").value = ""

    showVoluntarios("asc", "nome");

}