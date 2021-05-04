//Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 


window.addEventListener("load", principal);

function principal(){ 
    
    addAcao();
    closeAcao();
    showAcoes();
    createAcao();

}

function addAcao(){
    let botao = document.getElementById("addacao")
    let acaoform = document.getElementById("acaoform")

    botao.addEventListener("click", function(){
        acaoform.setAttribute("class", "w3-container w3-border w3-border-black w3-round visible")
    })
}

function closeAcao(){
    let botao = document.getElementById("closeActionForm")
    let acaoform = document.getElementById("acaoform")

    botao.addEventListener("click", function(){
        acaoform.setAttribute("class", "w3-container hidden")
        document.getElementById("tituloAcao").value = ""
        document.getElementById("areaacao").value = ""
        document.getElementById("populacaoacao").value = ""
        document.getElementById("funcaoacao").value = ""
        document.getElementById("nVagas").value = ""
        document.getElementById("distrito").value = ""
        document.getElementById("concelho").value = ""
        document.getElementById("freguesia").value = ""
        document.getElementById("diaacao").value = ""
        document.getElementById("horaacao").value = ""
        document.getElementById("duracaoacao").value = ""
    })
}

function closeA() {
    let acaoform = document.getElementById("acaoform")
    acaoform.setAttribute("class", "w3-container hidden")
    document.getElementById("tituloAcao").value = ""
    document.getElementById("areaacao").value = ""
    document.getElementById("populacaoacao").value = ""
    document.getElementById("funcaoacao").value = ""
    document.getElementById("nVagas").value = ""
    document.getElementById("distrito").value = ""
    document.getElementById("concelho").value = ""
    document.getElementById("freguesia").value = ""
    document.getElementById("diaacao").value = ""
    document.getElementById("horaacao").value = ""
    document.getElementById("duracaoacao").value = ""
}

function showAcoes() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("showingAcoes").innerHTML = this.responseText
        }
    }
    xmlhttp.open("POST", "../Controller/PreferenciasIController.php?show_acoes=yes", true);
    xmlhttp.send(); 
}

function createAcao() {
    $("form#acaoform").submit(function(e) {
        e.preventDefault();    
        var formData = new FormData(this);
    
        $.ajax({
            url: "../Controller/PreferenciasIController.php",
            type: 'POST',
            data: formData,
            success: function (data) {
                if (data.trim() == "Inseriu.") {
                    showAcoes()
                    closeA()
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
}

function removeAcao(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showAcoes()
        }
    }
    xmlhttp.open("POST", "../Controller/PreferenciasIController.php?remove_acao="+String(id), true);
    xmlhttp.send(); 
}