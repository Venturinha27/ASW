//Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 


window.addEventListener("load", principal);

function principal(){ 
    
    showTodosUtilizadores()
    showTodosConvites()
    showTodasCandidaturas()
    showTodasParticipacoes()

}

function showTodosUtilizadores() {
    let divtodos = document.getElementById('todosUtilizadoresDiv')
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            divtodos.innerHTML = this.responseText
        }
    }
    xmlhttp.open("GET", "../Controller/AdminController.php?show_todos_utilizadores=yes", true);
    xmlhttp.send();
}

function showTodosConvites() {
    let divconvites = document.getElementById('todosConvitesDiv')
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            divconvites.innerHTML = this.responseText
        }
    }
    xmlhttp.open("GET", "../Controller/AdminController.php?show_todos_convites=yes", true);
    xmlhttp.send();
}

function showTodasCandidaturas() {
    let divcandidaturas = document.getElementById('todasCandidaturasDiv')
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            divcandidaturas.innerHTML = this.responseText
        }
    }
    xmlhttp.open("GET", "../Controller/AdminController.php?show_todas_candidaturas=yes", true);
    xmlhttp.send();
}

function showTodasParticipacoes() {
    let divparticipacoes = document.getElementById('todasParticipacoesDiv')
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            divparticipacoes.innerHTML = this.responseText
        }
    }
    xmlhttp.open("GET", "../Controller/AdminController.php?show_todas_participacoes=yes", true);
    xmlhttp.send();
}