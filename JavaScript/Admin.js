//Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 


window.addEventListener("load", principal);

function principal(){ 
    
    showTodosUtilizadores()
    showTodosConvites()
    showTodasCandidaturas()
    showTodasParticipacoes()

}

function showTodosUtilizadores() {

    let id = document.getElementById("id").value
    let nome = document.getElementById("nome").value
    let distrito = document.getElementById("distrito").value
    let concelho = document.getElementById("concelho").value
    let freguesia = document.getElementById("freguesia").value
    let tipo = document.getElementById("tipo").value

    let divtodos = document.getElementById('todosUtilizadoresDiv')
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            divtodos.innerHTML = this.responseText
        }
    }
    xmlhttp.open("GET", "../Controller/AdminController.php?show_todos_utilizadores=yes&id="+id+"&nome="+nome
    +"&distrito="+distrito+"&concelho="+concelho+"&freguesia="+freguesia+"&tipo="+tipo, true);
    xmlhttp.send();
}

function LimparProcuraUtilizadores() {

    document.getElementById("id").value = ""
    document.getElementById("nome").value = ""
    document.getElementById("distrito").value = ""
    document.getElementById("concelho").value = ""
    document.getElementById("freguesia").value = ""
    document.getElementById("tipo").value = ""

    showTodosUtilizadores();

}

function showTodosConvites() {

    let con_voluntario = document.getElementById("con_voluntario").value
    let con_instituicao = document.getElementById("con_instituicao").value
    let con_acao = document.getElementById("con_acao").value
    let con_estado = document.getElementById("con_estado").value
    let con_data = document.getElementById("con_data").value

    let divconvites = document.getElementById('todosConvitesDiv')
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            divconvites.innerHTML = this.responseText
        }
    }
    xmlhttp.open("GET", "../Controller/AdminController.php?show_todos_convites=yes&con_voluntario="+con_voluntario+
    "&con_instituicao="+con_instituicao+"&con_acao="+con_acao+"&con_estado="+con_estado+"&con_data="+con_data, true);
    xmlhttp.send();
}

function LimparProcuraConvites() {

    document.getElementById("con_voluntario").value = ""
    document.getElementById("con_instituicao").value = ""
    document.getElementById("con_acao").value = ""
    document.getElementById("con_estado").value = ""
    document.getElementById("con_data").value = ""

    showTodosConvites();

}

function showTodasCandidaturas() {

    let can_voluntario = document.getElementById("can_voluntario").value
    let can_instituicao = document.getElementById("can_instituicao").value
    let can_acao = document.getElementById("can_acao").value
    let can_estado = document.getElementById("can_estado").value
    let can_data = document.getElementById("can_data").value

    let divcandidaturas = document.getElementById('todasCandidaturasDiv')
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            divcandidaturas.innerHTML = this.responseText
        }
    }
    xmlhttp.open("GET", "../Controller/AdminController.php?show_todas_candidaturas=yes&can_voluntario="+can_voluntario+
    "&can_instituicao="+can_instituicao+"&can_acao="+can_acao+"&can_estado="+can_estado+"&can_data="+can_data, true);
    xmlhttp.send();
}

function LimparProcuraCandidaturas() {

    document.getElementById("can_voluntario").value = ""
    document.getElementById("can_instituicao").value = ""
    document.getElementById("can_acao").value = ""
    document.getElementById("can_estado").value = ""
    document.getElementById("can_data").value = ""

    showTodasCandidaturas();

}

function showTodasParticipacoes() {

    let par_voluntario = document.getElementById("par_voluntario").value
    let par_instituicao = document.getElementById("par_instituicao").value
    let par_acao = document.getElementById("par_acao").value

    let divparticipacoes = document.getElementById('todasParticipacoesDiv')
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            divparticipacoes.innerHTML = this.responseText
        }
    }
    xmlhttp.open("GET", "../Controller/AdminController.php?show_todas_participacoes=yes&par_voluntario="+par_voluntario+
    "&par_instituicao="+par_instituicao+"&par_acao="+par_acao, true);
    xmlhttp.send();
}

function LimparProcuraParticipacoes() {

    document.getElementById("par_voluntario").value = ""
    document.getElementById("par_instituicao").value = ""
    document.getElementById("par_acao").value = ""

    showTodasParticipacoes();

}