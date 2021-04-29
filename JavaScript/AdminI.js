//Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 


window.addEventListener("load", principal);

function principal(){ 
    
    showInstituicoes("asc", "nome")

}

function showInstituicoes(order, variable) {

    let nome = document.getElementById("nome").value
    let distrito = document.getElementById("distrito").value
    let concelho = document.getElementById("concelho").value
    let freguesia = document.getElementById("freguesia").value
    let email = document.getElementById("email").value

    let divins = document.getElementById('resultadoInstituicoes')
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            divins.innerHTML = this.responseText
        }
    }
    xmlhttp.open("GET", "../Controller/AdminIController.php?show_instituicoes=yes&nome="+nome+
    "&distrito="+distrito+"&concelho="+concelho+"&freguesia="+freguesia+"&email="+email
    +"&order="+order+"&variable="+variable, true);
    xmlhttp.send();

}

function LimparProcura() {

    document.getElementById("nome").value = ""
    document.getElementById("distrito").value = ""
    document.getElementById("concelho").value = ""
    document.getElementById("freguesia").value = ""
    document.getElementById("email").value = ""

    showInstituicoes("asc", "nome");

}